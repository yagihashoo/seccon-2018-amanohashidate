@extends('layouts.app')
@section('title', 'Rule')

@section('content')
    <ul>
        <li>Challenge一覧に同時に掲載される問題は1チーム1問のみです。</li>
        <li>公開中の問題がない場合のみ新しい問題を登録できます。</li>
        <li>問題の達成判定は `alert('XSS')` またはそれと同等のコードを実行できたか否かによっておこないます。</li>
        <li>Payloadは `location.search` 経由で渡されます。(形式: `/?${encodeURIComponent(payload)}` )</li>
        <li>動作検証環境サーバで設定している特筆すべきヘッダは以下のとおりです。
            <ul>
                <li>Content-Security-Policy: default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob:</li>
                <li>X-XSS-Protection: 0</li>
                <li>Content-Type: text/html; charset=utf-8</li>
            </ul>
        </li>
        <li>動作検証環境のページロードのタイムアウトは1000msです。ロード完了後500msの待機時間があります。</li>
        <li>動作検証に用いるブラウザは `Google Chrome 71.0.3578.98` です。</li>
        <li>Defense pointの分配は<a href="{{ route('unsolved') }}">こちら</a>のページの解かれていない問題のタイトル一覧をもとにおこないます。</li>
        <li>このサーバでは各所にRate Limitを設定しています。ご留意ください。</li>
    </ul>
@endsection
