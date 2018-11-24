@extends('layouts.app')

@section('content')
    <div style="width:600px;margin:auto;margin-top:100px;font-family:monospace">
        <h1>XSS Hell</h1>
        <form method="post">
            <div><label>Username:<input name="name" type="text" placeholder="username" autofocus></label></div>
            <div><label>Password:<input name="password" type="password" placeholder="password"></label></div>
            <div><input type="submit" formaction="{{ route('login') }}" value="Login">
                <input type="submit" formaction="{{ route('register') }}" value="Register"></div>
            @csrf
        </form>
    </div>
@endsection