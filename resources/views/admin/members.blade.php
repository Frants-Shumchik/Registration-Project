@extends('layouts.admin')

@section('content')
    <h1 class="ui header">Organization information</h1>
    <form method="post" action="/admin/organization" class="ui form">
        @csrf
        <div class="field">
            <label>Organization name</label>
            <input type="text" name="organizationName" value="{{ $organization->name }}" placeholder="Organization name">
        </div>
        <div class="field">
            <label>Organization address</label>
            <input type="text" name="organizationAddress" value="{{ $organization->address }}" placeholder="Organization address">
        </div>
        <button class="ui button primary" type="submit">Save</button>
    </form>
    <h1 class="ui header">Organization Members Table</h1>
    <table class="ui celled table">
        <thead>
        <tr>
            <th>#</th>
            <th>Personal code</th>
            <th>First name</th>
            <th>Last name</th>
        </tr>
        </thead>
        <tbody>
        @if (count($members) > 0)
            @php $index = 1 @endphp
            @foreach ($members as $member)
                <tr{{ !$member->user_id ? " class=warning" : '' }}>
                    <td>{{ $index++ }}</td>
                    <td>{{ $member->personal_code }}</td>
                    @if ($member->user_id && $member->user)
                        <td>{{ $member->user->firstName }}</td>
                        <td>{{ $member->user->lastName }}</td>
                    @else
                        <td><i class="attention icon"></i>None</td>
                        <td><i class="attention icon"></i>None</td>
                    @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td class="center aligned" colspan="4">No members have been added yet</td>
            </tr>
        @endif
        </tbody>
    </table>
    <div class="ui grid centered aligned">
        <div class="eight wide column">
            <div class="ui segment">
                <h3>Add personal code</h3>
                <form method="post" class="ui form">
                    @csrf
                    <div class="inline fields">
                        <div class="sixteen wide field">
                            <input type="text" name="personal_code" value="{{ $random_code }}" placeholder="Personal code">
                            <button class="ui button" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection