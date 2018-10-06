@extends('layouts.app')

@section('content')
    <form method="post">
        <input name="name" type="text" placeholder="username" autofocus>
        <input name="password" type="password" placeholder="password">
        <input type="submit" formaction="{{ route('login') }}" value="Login">
        <input type="submit" formaction="{{ route('register') }}" value="Register">
        @csrf
    </form>
@endsection