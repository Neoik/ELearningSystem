@extends('layouts.app')

@section('content')
    <div class="container">


        @if(count($errors))
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <strong>{{ $error }}</strong>
                </div>
            @endforeach
        @endif


    </div>

    <div class="pricing-header text-center">
        <h1>{{ $problem->name }}</h1>
        <p>
time limit per test: {{ $problem->max_time}} seconds<br>
memory limit per test: {{ $problem->max_mem }} megabytes<br>
input: standard input<br>
output: standard output<br>
        </p>
    </div>
    <div class="container">

            @foreach(explode("\n", $problem->description) as $desc)
            <div class="row">
                <p>{{ $desc }}</p>
            </div>
            @endforeach


        <div class="row">
            <h3>Input data</h3>
        </div>
        <div class="row">
            <p>{{ $problem->input_description }}</p>
        </div>
        <div class="row">
            <h3>Output data</h3>
        </div>
        <div class="row">
            <p>{{ $problem->output_description }}</p>
        </div>
        <div class="row">
            <h3>Examples</h3>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="30">#</th>
                        <th class="text-center">INPUT</th>
                        <th class="text-center">OUTPUT</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($io_examples as $io_example)
                    <tr style="background-color:#efefef;">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td style="color:#800;">{{ $io_example->input }}</td>
                        <td style="color:#800;">{{ $io_example->output }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <h3>Send solution</h3>
        </div>
        <div class="row">
            {{ Form::open(array('route' => 'submit', 'files' => true)) }}
            <div class="form-group">
            {{ Form::file('file', array('class' => 'form-control-file')) }}
            </div>
            {{ Form::hidden('problem_id', $problem->id) }}
            {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
