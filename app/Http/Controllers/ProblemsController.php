<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;

use function MongoDB\BSON\toJSON;

class ProblemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function problems(Request $request) {
        return view('problems', ['problems' => Problem::all()]);
    }

    public function problem(Request $request, Problem $prob) {
        $io_examples = $prob->ioExamples;
        return view('problem', ['problem' => $prob, 'io_examples' => $io_examples]);
    }
}
