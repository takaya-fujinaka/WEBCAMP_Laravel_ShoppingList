<!DOCTYPE html>
<html lang="ja">
    @extends('admin.layout')
    
    {{-- メインコンテンツ --}}
    @section('contets')
    <body>
        <menu label="リンク">
        <a href="./index.html">管理画面Top</a><br>
        <a href="/admin/user/list">ユーザ一覧</a><br>
        <a href="/admin/logout">ログアウト</a><br>
        </menu>
        
        <h1>管理画面</h1>
    @endsection
    </body>
</html>