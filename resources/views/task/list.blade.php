<!DOCTYPE html>
<html lang="ja">
@extends('layout')

{{-- メインコンテンツ --}}
@section('contets')
    <body>
        <h1>「買うもの」の登録</h1>
            @if ($errors->any())
                <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                </div>
            @endif
        <form action="/task/register" method="post">
            @csrf
            「買うもの」名:<input neme="name"><br>
            <button>「買うもの」を登録する</button>
        </form>
        <h1>「買うもの」一覧</h1>
        <a href="./top.html">購入済み「買うもの」一覧</a><br>
        <table border="1">
        <tr>
            <th>登録日</th>
            <th>「買うもの」名</th>
        </tr>
        </table>
        <!--ページネーション -->
        現在 1 ページ目<br>
        <a href="./top.html">最初のページ</a> /
        <a href="./top.html">前に戻る</a> /
        <a href="./top.html">次に進む</a> /
        <br>
        <hr>
        <menu label="リンク">
        <a href="/logout">ログアウト</a><br>
        </menu>
@endsection
    </body>
</html>