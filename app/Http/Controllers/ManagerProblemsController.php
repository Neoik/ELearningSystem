<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use App\ProblemIOExample;
use App\ProblemIOTest;
use App\Http\Requests\CreateProblemAjax;
use App\Http\Requests\UpdateProblemAjax;
use App\Http\Requests\DeleteProblemAjax;

use App\Http\Requests\CreateProblemExampleAjax;
use App\Http\Requests\UpdateProblemExampleAjax;
use App\Http\Requests\DeleteProblemExampleAjax;

use App\Http\Requests\CreateProblemTestAjax;
use App\Http\Requests\UpdateProblemTestAjax;
use App\Http\Requests\DeleteProblemTestAjax;

use function MongoDB\BSON\toJSON;

class ManagerProblemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if(!$user->hasRole('manager')) {
                abort(404);
            }
            return $next($request);
        });
    }

    public function problems(Request $request) {
        return view('problems', ['problems' => Problem::all()]);
    }

    public function problem(Request $request, Problem $prob) {
        $io_examples = $prob->ioExamples;
        return view('problem', ['problem' => $prob, 'io_examples' => $io_examples]);
    }

    public function problems_short_info(Request $request) {
        return Problem::select(['id', 'name'])->get();
    }

    public function add_problem(Request $request) {
        return view('add_problem');
    }

    public function edit_problem(Request $request, Problem $prob) {
        return view('update_problem');
    }

    public function manage_problems(Request $request) {
        return view('manage', ['problems' => Problem::all()]);
    }

    public function create_problem(CreateProblemAjax $request) {
        $problem = Problem::create($request->all());
        return array('next' => route('edit_problem', $problem));
    }

    public function update_problem(UpdateProblemAjax $request, Problem $prob) {
        $prob->fill($request->all());
        $prob->save();
        return array('msg' => "Probmel updated");
    }

    public function delete_problem(Request $request, Problem $prob) {
        $prob->delete();
    }

    public function create_problem_io_example(CreateProblemExampleAjax $request, Problem $prob) {
        $problemExample = new ProblemIOExample();
        $problemExample->fill($request->all());
        $problemExample->problem_id = $prob->id;
        $problemExample->save();
        return array('msg' => "Problem example created", "id"=>$problemExample->id);
    }

    public function update_problem_io_example(UpdateProblemExampleAjax $request, Problem $prob) {
        $problem_io_example = ProblemIOExample::find($request->input('id'));
        $problem_io_example->fill($request->all());
        $problem_io_example->save();
    }

    public function delete_problem_io_example(DeleteProblemExampleAjax $request, Problem $prob) {
        ProblemIOExample::destroy($request->input('id'));
    }

    public function create_problem_io_test(CreateProblemTestAjax $request, Problem $prob) {
        $problemTest = new ProblemIOTest();
        $problemTest->fill($request->all());
        $problemTest->problem_id = $prob->id;
        $problemTest->save();
        return array('msg' => "Problem test created", "id"=>$problemTest->id);
    }

    public function update_problem_io_test(UpdateProblemTestAjax $request, Problem $prob) {
        $problem_io_test = ProblemIOTest::find($request->input('id'));
        $problem_io_test->fill($request->all());
        $problem_io_test->save();
    }

    public function delete_problem_io_test(DeleteProblemTestAjax $request, Problem $prob) {
        ProblemIOTest::destroy($request->input('id'));
    }

    public function problem_info(Request $request, Problem $prob) {
        return $prob;
    }

    public function problem_examples(Request $request, Problem $prob) {
        return ProblemIOExample::where('problem_id', $prob->id)->get();
    }

    public function problem_tests(Request $request, Problem $prob) {
        return ProblemIOTest::where('problem_id', $prob->id)->get();
    }

}
