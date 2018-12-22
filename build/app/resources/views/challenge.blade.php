@extends('layouts.app')
@section('title', 'Challenge')

@section('content')
    <table class="table is-fullwidth is-bordered">
        <tbody>
        <tr>
            <th>Title:</th>
            <td>{{ $challenge->title }}</td>
        </tr>
        <tr>
            <th>Setter:</th>
            <td>{{ $challenge->setter_id }}</td>
        </tr>
        <tr>
            <th>Team:</th>
            <td>{{ $team ? $team->name : 'UNKNOWN' }}</td>
        </tr>
        <tr>
            <th>Created at:</th>
            <td>{{ $challenge->created_at }}</td>
        </tr>
        <tr>
            <th>Updated at:</th>
            <td>{{ $challenge->updated_at }}</td>
        </tr>
        </tbody>
    </table>
    <a href="/challenge/{{ $challenge->id }}/download">
        <button class="button is-link">Download</button>
    </a>
    <form action="{{ route('answer', $challenge->id) }}" method="post">
        <h3 class="title is-3">Payload submission</h3>
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <span class="tag is-info is-medium">{{ session('message') }}</span>
        @elseif(\Illuminate\Support\Facades\Session::has('error'))
            <span class="tag is-warning is-medium">{{ session('error') }}</span>
        @endif
        <input class="input" type="text" name="payload" required autofocus
               placeholder="Payload will be passed like `/?${encodeURIComponent(payload)}`" maxlength="256">
        <input class="button" type="submit" value="submit">
        @csrf
    </form>
@endsection
