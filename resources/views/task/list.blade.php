<!DOCTYPE html>
<html lang="ja">
@extends('layout')

{{-- メインコンテンツ --}}
@section('contets')
    <body>
        <h1>「買うもの」の登録</h1>
            @if (session('front.task_register_success') == true)
                「買うもの」を登録しました！！
            @endif
            @if (session('front.task_delete_success') == true)
                「買うもの」を削除しました！！
            @endif
            @if (session('front.task_completed_success') == true)
                 「買うもの」を完了にしました！！<br>
            @endif
            @if (session('front.task_completed_failure') == true)
                 「買うもの」の完了に失敗しました....<br>
            @endif
            @if ($errors->any())
                <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                </div>
            @endif
        <form action="/task/register" method="post">
            @csrf
            「買うもの」名:<input name="name"><br>
            <button>「買うもの」を登録する</button>
        </form>
        <h1>「買うもの」一覧</h1>
        <a href="/completed_shopping/list">購入済み「買うもの」一覧</a><br>
        <table border="1">
        <tr>
            <th>登録日</th>
            <th>「買うもの」名</th>
        </tr>
        @foreach ($list as $task)
        <tr>
            <td>{{  $task->created_at->format('Y/m/d') }}</td>
            <td>{{ $task->name }}</td>
            <td><form action="{{ route('complete', ['task_id' => $task->id]) }}" method="post"> @csrf <button onclick='return confirm("このタスクを「完了」にします。よろしいですか？");' >完了</button></form></td>
            <td><form action="{{ route('delete', ['task_id' => $task->id]) }}" method="post">
                 @csrf 
                 @method("DELETE")
                 <button onclick='return confirm("このタスクを「削除」にします(削除したら戻せません)。よろしいですか？");' >削除</button></form></td>
        </tr>
        @endforeach
        </table>
        <!--ページネーション -->
        現在 {{ $list->currentPage() }} ページ目<br>
        @if ($list->onFirstPage() === false)
        <a href="/task/list">最初のページ</a> 
        @else
        最初のページ
        @endif
        /
        @if ($list->previousPageUrl() !== null)
            <a href="{{ $list->previousPageUrl() }}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if ($list->nextPageUrl() !== null)
            <a href="{{ $list->nextPageUrl() }}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
        <hr>
        <menu label="リンク">
        <a href="/logout">ログアウト</a><br>
        </menu>
@endsection
    </body>
</html>