@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<table class="table is-fullwidth">
    <thead>
    <tr>
        <th>name</th>
        <th>value</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>id</td>
        <td>{{ $user->id }}</td>
    </tr>
    </tbody>
    <tr>
        <td>name</td>
        <td>{{ $user->name }}</td>
    </tr>
</table>
<h2 class="title is-3">Uploaded Challenges</h2>
 <table class="table is-fullwidth is-striped">
    <thead>
        <th>status</th>
        <th>id</th>
        <th>title</th>
    </thead>
    <tbody>
    @foreach( $challenges as $challenge)
        <tr>
            <td>
            @if( $challenge->verified === 1)
                <span class="tag is-success">verified</span>
            @endif
            @if( $challenge->solved === 1)
                <span class="tag is-warning">solved</span>
            @endif
            </td>
            <td>{{ $challenge->id }}</td>
            <td>{{ $challenge->title }}</td>
        </tr>
    @endforeach
    </tbody>
 </table>
 {{ $challenges->links() }}
@endsection
