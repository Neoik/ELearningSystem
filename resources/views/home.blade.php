@extends('layouts.app')

@section('content')
    <home-component
        my_submissions_route="{{route('my_submissions')}}"
        all_submissions_route={{ route('status_page') }}
        first_problem_route={{ route('problem', 1)  }}
    ></home-component>
@endsection
