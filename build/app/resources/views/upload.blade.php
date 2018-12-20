@extends('layouts.app')
@section('title', 'Upload Challenge')

@section('content')
    <form action="{{ route('create') }}" method="post">
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <span class="tag is-info is-medium">{{ session('message') }}</span>
        @elseif(\Illuminate\Support\Facades\Session::has('error'))
            <span class="tag is-warning is-medium">{{ session('error') }}</span>
        @endif
        <input class="input" type="text" name="title" placeholder="title" maxlength="64">
        <input class="input" type="text" name="model_answer" placeholder="model answer (up to 256 bytes) which will be passed like `/?${payload}`" maxlength="256">
        <textarea class="textarea" maxlength="4096" name="html" placeholder="html (up to 4096 bytes)"></textarea>
        <input class="button" type="submit" value="submit">
        @csrf
    </form>
@endsection
