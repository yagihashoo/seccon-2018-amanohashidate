@extends('layouts.app')
@section('title', 'Top')

@section('content')

 <table class="table is-fullwidth is-striped">
    <thead>
        <th>id</th>
        <th>title</th>
    </thead>
    <tbody>
    @foreach( $challenges as $challenge)
        <tr>
            <td>{{ $challenge->id }}</td>
            <td>
                <a href="/challenge?id={{ $challenge->id }}">{{ $challenge->title }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
 </table>
 {{ $challenges->links() }}
@endsection
