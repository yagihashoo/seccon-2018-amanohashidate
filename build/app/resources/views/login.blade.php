@extends('layouts.app')

@section('content')
    <h1>XSS Hell</h1>
    <form method="post" class="siimple-form">
        <div class="siimple-form-field">
            <label>Username:<input class="siimple-input siimple-input--fluid" name="name"
                                   type="text" placeholder="username" autofocus>
            </label>
        </div>
        <div class="siimple-form-field">
            <label>Password:<input class="siimple-input siimple-input--fluid"
                                   name="password" type="password"
                                   placeholder="password">
            </label>
        </div>
        <div class="siimple-form-field">
            <input class="siimple-btn siimple-btn--blue" type="submit" formaction="{{ route('login') }}" value="Login">
            <input class="siimple-btn siimple-btn--blue" type="submit" formaction="{{ route('register') }}"
                   value="Register">
        </div>
        @csrf
    </form>
@endsection