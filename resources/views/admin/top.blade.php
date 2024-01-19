<!DOCTYPE html>
<html lang="ja">
    @extends('admin.layout')
    
    {{-- メインコンテンツ --}}
    @section('contets')
    <body>
        <menu label="リンク">
        <a href="./index.html">管理画面Top</a><br>
        <a href="./user_list.html">ユーザ一覧</a><br>
        <a href="./index.html">ログアウト</a><br>
        </menu>
        
        <h1>管理画面</h1>
    @endsection
    </body>
</html>