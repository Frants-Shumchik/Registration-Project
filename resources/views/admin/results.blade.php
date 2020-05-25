@extends('layouts.admin')

@section('content')
    <h1 class="ui header">Personal results table</h1>
    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>User</th>
                <th>Test</th>
                <th>Complete time</th>
                <th>Spent time (minutes)</th>
                <th>Right Answers</th>
                <th>Mark</th>
            </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr class="center aligned">
                <td>
                    {{ $result->user->lastName }}
                    {{ $result->user->firstName }}
                </td>
                <td class="left aligned">
                    {{ $result->test->name }}
                </td>
                <td class="single line">
                    {{ $result->created_at }}
                </td>
                <td>
                    {{ number_format($result->spent_time / 60, 2) }}
                </td>
                <td>
                    {{ $result->correct }} /
                    {{ $result->test->questions->count() }}
                </td>
                <td>
                    <h2 class="ui center aligned header">{{ $result->mark }}</h2>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection