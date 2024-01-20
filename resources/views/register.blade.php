<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>会員登録</title>
    </head>
    <body>
        <h1>ユーザ登録</h1>
        @if (session('front.user_register_success') == true)
            ユーザを登録しました！！<br>
        @endif
        @if ($errors->any())
            <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            </div>
        @endif
        <form action="/user/register" method="post">
            @csrf
            名前:<input name="name"><br>
            email:<input name="email" type="email"><br>
            パスワード:<input name="password" type="password"><br>
            パスワード再度:<input type="password" name="password_confirmation"><br>
            <button>登録する</button>
        </form>
    </body>
</html>