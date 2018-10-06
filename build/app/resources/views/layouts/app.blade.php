<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Amanohashidate</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        div.content {
            width: 1000px;
            margin: auto;
        }
    </style>
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>
<div>
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>