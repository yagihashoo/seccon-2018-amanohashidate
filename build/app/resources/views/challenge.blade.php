@extends('layouts.app')
@section('title', 'Challenge')

@section('content')
    {{ $challenge->id }}
    <form action="/challenge/{{$challenge->id}}/answer" method="post">
        @csrf
        <input type="submit" value="submit"></form>
@endsection
