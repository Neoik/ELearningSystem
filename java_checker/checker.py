#!/usr/bin/env python3

import re
import os
import shutil
import tempfile
import subprocess
import io
import sys
import json

JAVA_SANDBOX_PATH = os.path.abspath(os.path.join(os.path.dirname(__file__), 'java_sandbox.jar'))
SECURITY_POLICY_PATH = os.path.abspath(os.path.join(os.path.dirname(__file__), 'java-security.policy'))
POLICY_PATH = os.path.abspath(os.path.join(os.path.dirname(__file__), 'security.policy'))

class STATUS:
    STATUS_PROCESSING    = 0;
    STATUS_ACCEPTED      = 1;
    STATUS_MEMORY_EXCEEDED = 2;
    STATUS_TIME_EXCEEDED = 3;
    STATUS_COMPILE_ERROR = 4;
    STATUS_RUNTIME_ERROR = 5;
    STATUS_WRONG_ANSWER  = 6;


recomment = re.compile(r'/\*.*?\*/', re.DOTALL | re.U)
restring = re.compile(r''''(?:\\.|[^'\\])'|"(?:\\.|[^"\\])*"''', re.DOTALL | re.U)
reinline_comment = re.compile(r'//.*?(?=[\r\n])', re.U)
reclass = re.compile(r'\bpublic\s+(?:strictfp\s+)?(?:(?:abstract|final)\s+)?(?:strictfp\s+)?class\s+([\w\$][\w\$]*?)\b', re.U)
repackage = re.compile(r'\bpackage\s+([^.;]+(?:\.[^.;]+)*?);', re.U)

def find_class(source):
    source = reinline_comment.sub('', restring.sub('', recomment.sub('', source)))
    class_name = reclass.search(source)
    if class_name is None:
        raise Exception('No public class: your main class must be declared as a \'public class\'')
    package = repackage.search(source)
    if package:
        raise Exception('Invalid package %s: do not declare package' % package.group(1))
    return class_name.group(1)

def enter_temp_dir():
    tempdir = tempfile.mkdtemp()
    os.chdir(tempdir)
    return tempdir

def leave_and_clear(dirname):
    os.chdir('/')
    clear_dir(dirname)

def clear_dir(dirname):
    shutil.rmtree(dirname)

def compile_class(class_name, source):
    filename = class_name + '.java'
    f = open(filename, 'wb')
    f.write(source.encode())
    f.close()

    compiler = 'javac'
    compiler_args = ['-encoding', 'UTF-8']
    args = []
    args.append(compiler)
    args.extend(compiler_args)
    args.append(filename)
    success = True
    msg = ''
    try:
        subprocess.check_output(args, stderr=subprocess.STDOUT)
    except Exception as e:
        msg = e.output.decode('utf-8')
        success = False
    return success, msg

def try_run(source, tests, max_time, max_mem):
    rval = dict()
    rval['status'] = STATUS.STATUS_ACCEPTED
    rval['msg'] = ''
    rval['tests'] = [] #(status, msg)
    try:
        class_name = find_class(source)
    except Exception as ex:
        msg = str(ex)
        rval['status'] = STATUS.STATUS_COMPILE_ERROR
        rval['msg'] = msg
        return rval

    success,msg = compile_class(class_name, source)
    if not success:
        rval['status'] = STATUS.STATUS_COMPILE_ERROR
        rval['msg'] = msg
        return rval

    for test in tests:
        status, msg = run_class(class_name, test, max_time, max_mem)
        rval['tests'].append((status, msg))
        if status != STATUS.STATUS_ACCEPTED:
            rval['status'] = status
            rval['msg'] = msg
            return rval
    return rval

'''
def check(source, tests, max_time, max_mem):
    dirname = enter_temp_dir()
    status,msg = try_run(source, tests, max_time, max_mem)
    leave_and_clear(dirname)
    return status,msg
'''

def check(source, tests, max_time, max_mem):
    dirname = enter_temp_dir()
    result = try_run(source, tests, max_time, max_mem)
    leave_and_clear(dirname)
    return result

def run_class(class_name, test_case, max_time, max_mem):
    #java vm takes itself ~vm (in my case), so add mem
    max_mem += 27 #found by experiments
    agent_flags = '-javaagent:{}=policy:{}'.format(JAVA_SANDBOX_PATH, POLICY_PATH)
    args = ['java',
            '-client',
            agent_flags,
            '-Xss128m',
            '-Xms4m',
            '-Xmx%dm' % max_mem,
            '-XX:+UseSerialGC',
            '-XX:ErrorFile=submission_jvm_crash.log',
            class_name]

    test_input, test_output = test_case
    test_input = test_input.encode()
    test_output = test_output.encode()
    try:
        stdout = subprocess.check_output(args, input=test_input, timeout=max_time)
        stdout = stdout.rstrip()
        if stdout != test_output:
            return STATUS.STATUS_WRONG_ANSWER, ''
    except subprocess.TimeoutExpired as e:
        return STATUS.STATUS_TIME_EXCEEDED, ''
    except subprocess.CalledProcessError as e:
        #print('\nnon 0 exit', e.cmd, e.returncode, e.output)
        if e.returncode == 1 and os.path.exists('state'):
            state = open('state').read().strip()
            '''
            print('-'*100)
            print('STATE: {}'.format(state))
            print('-'*100)
            '''
            if state == 'java.lang.OutOfMemoryError':
                return STATUS.STATUS_MEMORY_EXCEEDED, ''
            elif state.endswith('Exception'):
                return STATUS.STATUS_RUNTIME_ERROR, state
    return STATUS.STATUS_ACCEPTED, ''


if __name__ == '__main__':
    POLICY_PREFIX = '''\
    grant codeBase "file:///{agent}" {{
        permission java.io.FilePermission "state", "write";
    }};

    '''

    with open(SECURITY_POLICY_PATH) as policy_file:
        policy = policy_file.read()

    #policy_path = 'security.policy'
    with open(POLICY_PATH, 'w') as file:
        file.write(POLICY_PREFIX.format(agent=JAVA_SANDBOX_PATH) + policy)

    if len(sys.argv) != 2:
        os.exit(1)

    filename = sys.argv[1]
    submission = open(filename)
    submission = json.load(submission)
    #print(submission)
    result = check(submission['source'], submission['tests'], submission['max_time'], submission['max_mem'])
    result = json.dumps(result)
    print(result)
