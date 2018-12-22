@extends('layouts.app')
@section('title', 'Top')

@section('content')
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Team</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($challenges as $challenge)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('challenge', ['id' => $challenge->id]) }}">{{ $challenge->title }}</a></td>
                <td>{{ $challenge->team_name ?: 'UNKNOWN' }}</td>
            </tr>
        @empty
            No challenge yet
        @endforelse
        </tbody>
    </table>
@endsection
