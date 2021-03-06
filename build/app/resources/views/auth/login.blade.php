@extends('layouts.auth')

@section('content')
    <h1 class="title is-1">XSS Hell</h1>
    <h2>Login</h2>
    @foreach ($errors->all() as $e)
        <div class="notification is-danger">{{$e}}</div>
    @endforeach
    <form method="post">
        <div class="field">
            <label>Username:<input class="input" name="name" type="text" placeholder="username" autofocus required>
            </label>
        </div>
        <div class="field">
            <label>Password:<input class="input" name="password" type="password" placeholder="password" minlength="6" required>
            </label>
        </div>
        <div class="field">
            <input class="button is-link" type="submit" formaction="{{ route('login') }}" value="Login">
            <input class="button is-text" type="submit" formaction="{{ route('register') }}" value="Register">
        </div>
        @csrf
    </form>
@endsection
