<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\ProblemSumbission;
use App\ProblemSumbissionTest;
use App\Problem;
use App\ProblemIOTest;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $submission;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ProblemSumbission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = "/tmp/".$this->submission->user_id.":".$this->submission->problem_id.":".time();
        $myfile = fopen($path, "w");
        $submission = $this->submission;
        $problem_id = $submission->problem_id;
        $problem = Problem::find($problem_id);
        $problem->increment('submit_count');
        $tests = array();
        foreach(ProblemIOTest::where('problem_id', $problem_id)->cursor() as $problemTest) {
            $test = array($problemTest->input, $problemTest->output);
            array_push($tests, $test);
        }
        $sub = array("source" => $submission->source_code,
                    "max_mem" => $problem->max_mem,
                    "max_time" => $problem->max_time,
                    "tests" => $tests);
        fwrite($myfile, json_encode($sub, TRUE));
        fclose($myfile);
	$cmd = 'java_checker/checker.py '.$path;
        #$cmd = '/home/neoik/Desktop/ttt/java_checker/checker.py '.$path;
        $result = shell_exec($cmd);
        $result = json_decode($result, true);

        $submission->status = $result['status'];
        if (count($result['tests']) == 0) {
            $submissionTest = new ProblemSumbissionTest;
            $submissionTest->submission_id = $submission->id;
            $submissionTest->msg = $result['msg'];
            $submissionTest->status = $result['status'];
            $submissionTest->save();
        } else {
            foreach($result['tests'] as $test) {
                $submissionTest = new ProblemSumbissionTest;
                $submissionTest->submission_id = $submission->id;
                $submissionTest->status = $test[0];
                $submissionTest->msg = $test[1];
                $submissionTest->save();
            } 
        }
        if($submission->status == ProblemSumbission::STATUS_ACCEPTED){
            $problem->increment('solve_count');
        }
        $submission->save();
    }
}
