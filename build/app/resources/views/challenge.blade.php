@extends('layouts.app')
@section('title', 'Challenge')

@section('content')
@if($challenge === null)
    Challenge not found.
@else
    <table class="table is-fullwidth is-bordered">
		<tbody>
			<tr>
				<th>Title:</th>
				<td>{{ $challenge->title }}</td>
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
	<table>
    <a href="/challenge/{{ $challenge->file_id }}">
        <button class="button is-link">Donwload</button>
    </a>
        <form action="/challenge/{{$challenge->id}}/answer" method="post">
        	<h3 class="title is-3">Payload submission</h3>
            <input class="input" type="text" name="payload" placeholder="#alert(/XSS/.source)"/>
            <input class="button" type="submit" value="submit"/>
            @csrf
        </form>
@endif
@endsection
