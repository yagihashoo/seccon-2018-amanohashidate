<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - XSS Hell</title>
    <link href="{{ asset('css/bulma.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a href="{{ route('top') }}" class="title is-1 navbar-item">XSS Hell</a></a>
                </div>
                <div class="navbar-menu">
                    <div class="navbar-end">
                        <a href="{{ route('top') }}" class="navbar-item">Challenges</a>
                        <a href="{{ route('upload') }}" class="navbar-item">Upload</a>
                        <a href="{{ route('me') }}" class="navbar-item">Profile</a>
                        <a href="{{ route('logout') }}" class="navbar-item">Logout</a>
                    </div>
                </div>
            </nav>
        </header>
    <div class="content">
    <h2 class="title is-3">@yield('title')</h2>
        @yield('content')
    </div>
    <footer>
        ©Yu YAGIHASHI, Developed For SECCON CTF 2018
    </footer>
</body>
</html>
