<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\ProblemSumbission;
use App\Http\Requests\SolutionPostRequest;
use Illuminate\Support\Facades\Auth;

use App\Jobs\ProcessSubmission;
use App\ProblemSumbissionTest;

class ProblemSumbissionController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function recent(Request $request)
  {
      return view('status');
  }

  public function recent_json()
  {
      $recent_submissions = ProblemSumbission::orderBy('id', 'desc')->take(20)->get();
      return $recent_submissions->toJson();
  }

  public function submission(Request $request, ProblemSumbission $sub) {
      $user_id  = $request->user()->id;
      if ($request->user()->hasRole('user') && $user_id != $sub->user_id)
          return redirect()->route('status_page');
      return view('submission');
    }

    public function submission_mine(Request $request) {
        return view('my_submissions');
    }

    public function my_submissions_json(Request $request) {
        $user_id  = $request->user()->id;
        $my_submissions = ProblemSumbission::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return $my_submissions->toJson();
    }

  public function submission_json(Request $request, ProblemSumbission $sub) {
      $user_id  = $request->user()->id;
      if ($user_id != $sub->user_id)
          return redirect()->route('status_page');
      $tests = array();
      foreach(ProblemSumbissionTest::where('submission_id', $sub->id)->cursor() as $test) {
        array_push($tests, array($test->status, $test->msg));
        }
      $submission_info = array();
      $submission_info['source'] = $sub->source_code;
      $submission_info['status'] = $sub->status;
      $submission_info['problem_id'] = $sub->problem_id;
      $submission_info['tests'] = $tests;
      return json_encode($submission_info);
    }

  public function submit(SolutionPostRequest $request) {
    $file = $request->file('file');
    if ($file->getClientOriginalExtension() != 'java') {
        return back()->withErrors(['extention' => 'Not a java file.']); 
    }
    $source_code = file_get_contents($file->getRealPath());
    $user_id  = $request->user()->id;
    $problem_id = $request->input('problem_id');
    $submission = new ProblemSumbission;
    $submission->user_id = $user_id;
    $submission->problem_id = $problem_id;
    $submission->source_code = $source_code;
    $submission->status = ProblemSumbission::STATUS_PROCESSING;
    $submission->max_time = 0;
    $submission->max_mem = 0;
    $submission->save();
    ProcessSubmission::dispatch($submission);
    return redirect()->route('submission', ['sub' => $submission->id]);
  }
}
