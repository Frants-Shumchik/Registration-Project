@extends('layouts.admin')

@section('content')
    <h1 class="ui header">Organization Test List</h1>
    <table class="ui compact celled definition table">
        <thead>
            <tr>
                <th>Active</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created</th>
                <th>Questions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tests as $test)
            <tr>
                <td class="collapsing">
                    <div class="ui fitted toggle checkbox">
                        <form action="{{ url('admin/tests/' . $test->id) }}" method="POST" id="testStatus">
                            @method('PATCH')
                            @csrf
                            <input name="is_active" type="checkbox"{{ $test->is_active ? ' checked' : '' }}>
                            <label></label>
                        </form>
                    </div>
                </td>
                <td>{{ $test->name }}</td>
                <td>{{ $test->description }}</td>
                <td>{{ $test->created_at }}</td>
                <td>{{ $test->questions->count() }}</td>
                <td>
                    <div style="display: flex">
                        <a href="tests/{{ $test->id }}" class="ui small blue button">Edit</a>
                        <form action="{{ url('admin/tests/' . $test->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="ui small red button">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot class="full-width">
        <tr>
            <th colspan="6">
                <a href="{{ url('admin/tests/create') }}">
                    <div class="ui right floated small green labeled icon button">
                        <i class="clipboard icon"></i> Add Test
                    </div>
                </a>
            </th>
        </tr>
        </tfoot>
    </table>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#testStatus input[type="checkbox"]').each((index, input) => {
                input.onchange = () => input.parentNode.submit();
            });
        });
    </script>
@endsection