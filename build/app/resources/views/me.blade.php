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
@endsection
