@extends('layouts.app')
@section('title', 'Top')

@section('content')
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>IP</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($challenges as $challenge)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('challenge', ['id' => $challenge['id']]) }}">{{ $challenge['title'] }}</a></td>
                <td>{{ $challenge['from_ip0'] }}.{{ $challenge['from_ip1'] }}.{{ $challenge['from_ip2'] }}.{{ $challenge['from_ip3'] }}</td>
            </tr>
        @empty
            No challenge yet
        @endforelse
        </tbody>
    </table>
@endsection
