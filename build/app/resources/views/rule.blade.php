@extends('layouts.app')
@section('title', 'Rule')

@section('content')
    <ul>
        <li>Challenge一覧に同時に掲載される問題は1チーム1問のみです。</li>
        <li>公開中の問題がない場合のみ新しい問題を登録できます。</li>
        <li>Payloadは `location.search` 経由で渡されます。(形式: `/?${payload}` )</li>
        <li>動作検証環境サーバではCSP( `default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob:` )が有効です。</li>
        <li>動作検証環境サーバのContent-Typeヘッダの設定値は `text/html; charset=utf-8` です。</li>
        <li>動作検証環境のタイムアウトは2000msです。</li>
        <li>動作検証に用いるブラウザは `Google Chrome 71.0.3578.98` です。</li>
        <li>Defense pointの付与は<a href="{{ route('unsolved') }}">こちら</a>のページの解かれていない問題のタイトル一覧をもとにおこないます。</li>
        <li>各所にRate Limitを設定しています。ご留意ください。</li>
    </ul>
@endsection
