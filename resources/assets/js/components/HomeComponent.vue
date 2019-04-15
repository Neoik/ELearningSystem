<template>
    <div class="container">
        <p>This site contains an archive of tasks on olympiad programming with an integrated checking system. To participate in the system, it is enough to register and open the "Problems" tap, where at the moment you will be offered to solve 10 tasks of various complexity. The complexity of tasks is determined by the solvability persentage (how many subbmitted solutions was completely correct).</p>
        <p>System assume to solution to read standart input and put result in standart output strap respectively. Only registered users can submit a solution as a file with this extentions: *.java.</p>
        <h5>Currently system has support for this compilers:</h5>

        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn collapsed" data-toggle="collapse" data-target="#collapse0" aria-expanded="false" aria-controls="collapse0">
                            Java 8 OpenJDK Runtime Environment
                        </button>
                    </h5>
                </div>
                <div id="collapse0" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <p>As a file user should upload file with java extention. This solution must have exactly on public class with any name with main function</p>
                        <p>Compiller and java virtual machines are run with folloing parametrs:</p>
                        <highlight-code lang="bash">
                            $ javac -encoding UTF-8 Main.java
                            $ java -Xmx768m -Xss64m -Xms4m -XX:+UseSerialGC Main
                        </highlight-code>
                        <p>Example of solution for the <a v-bind:href="first_problem">"A+B"</a> problem:</p>
                        <highlight-code lang="java">
                            import java.io.*;
                            import java.util.*;

                            public class Main{
                                public static void main(String[] args){
                                    Scanner in = new Scanner(System.in);
                                    PrintWriter out = new PrintWriter(System.out);

                                    int a = in.nextInt();
                                    int b = in.nextInt();
                                    out.println(a + b);

                                    out.flush();
                                }
                            }
                        </highlight-code>
                    </div>
                </div>
            </div>
        </div>

        <p>Each submitted solution is tested on the server. There are at least ten tests created in order to test all edge cases for a particular problem. Problem is considered solved only if ALL tests were correct. In case of incorrect answer, testing process stops on current test and determine error. You can find results of your submissions in
        <a v-bind:href="my_submissions">"My submissions"</a> tab and also you can see results of all submissions from other participants in <a v-bind:href="all_submissions">"All submissions"</a> tab. Final result of the rest is the final message from system and number of test, that caused error (in case it exists).
            By clicking on submission id in "My submissions" tab users can see their submitted source code and results of errors in case of "Compilation error" or "Runtime error".
        </p>
        <p>Here is the list of all possible messages from system.</p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col"  width="5%">Message</th>
                <th scope="col"  width="45%">Event</th>
                <th scope="col"  width="45%">Reason</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td class="text-center text-success" >Accepted</td>
                <td>Program works correctly, passed all tests with specified time and memory limits.</td>
                <td>Bad tests from our side :)</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td class="text-center text-danger" >Wrong answer</td>
                <td>Wrong answer. Output of program do not much expected output.</td>
                <td>Wrong output format or mistake in alghoritm.</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td class="text-center text-danger">Compilation error</td>
                <td>Compilation error. No execution file is created after compilation step.</td>
                <td>Syntax error in program.</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td class="text-center text-danger">Runtime error</td>
                <td>Runtime error. Program return not 0 status or crashed. Output is not checked in this case.</td>
                <td>Maybe user tried to access not existing element in array or devide by zero.</td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td class="text-center text-danger">Time limit exceeded</td>
                <td>Time limit specified for problem is exceeded. Program to much time to execute.</td>
                <td>Not effective sollution or mistake in alghoritm.</td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td class="text-center text-danger">Memory limit exceeded.</td>
                <td>Memory limit specified for problem is exceeded. Program allocated to much memory.</td>
                <td>Not effective sollution or bad memory allocation.</td>
            </tr>

            <tr>
                <th scope="row">7</th>
                <td class="text-center text-secondary">Processing</td>
                <td>Submission requst was put to processing queue.</td>
                <td>Submision currently is check by many tests.</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['my_submissions_route', 'all_submissions_route', 'first_problem_route'],
        data() {
            return {
                all_submissions: this.all_submissions_route,
                my_submissions: this.my_submissions_route,
                first_problem: this.first_problem_route,
            }
        },
        mounted: function() {
            console.log('mounted', this);
        },
    }
</script>
