@extends('layouts.app')

@section('content')
    <h1>XSS Hell</h1>
    <form method="post">
        <div class="field">
            <label>Username:<input class="input" name="name" type="text" placeholder="username" autofocus>
            </label>
        </div>
        <div class="field">
            <label>Password:<input class="input" name="password" type="password" placeholder="password">
            </label>
        </div>
        <div class="field">
            <input class="button is-link" type="submit" formaction="{{ route('login') }}" value="Login">
            <input class="button is-text" type="submit" formaction="{{ route('register') }}"
                   value="Register">
        </div>
        @csrf
    </form>
@endsection