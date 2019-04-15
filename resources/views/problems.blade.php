@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Problem</th>
                    <th scope="col">Accepted</th>
                    <th scope="col">Solved</th>
                    <th scope="col">Solvebility</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($problems as $problem)
                    <tr>
                        <td>
                            {{ $problem->id }}
                        </td>
                        <td>
                            <a href="{{ route('problem', $problem) }}">{{ $problem->name }}</a>
                        </td>
                        <td>
                            {{ $problem->submit_count }}
                        </td>
                        <td>
                            {{ $problem->solve_count }}
                        </td>
                        <td>
                        @if($problem->submit_count)
                            {{ number_format($problem->solve_count / $problem->submit_count, 2, '.', '')*100}}%
                        @else
                            0
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
