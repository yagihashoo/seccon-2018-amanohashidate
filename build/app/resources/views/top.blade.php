@extends('layouts.app')
@section('title', 'Top')

@section('content')
<ul>
    <li key={challenge.id}>
        <p>{challenge.id}</p>
        <p>{challenge.name}</p>
    </li>
</ul>
@endsection
