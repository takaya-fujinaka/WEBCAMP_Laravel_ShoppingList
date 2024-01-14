<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * トップページを表示する
     * @return\Illuminate\View\View
     */
     public function index()
     {
         return view('index');
     }
     
    /**
     * ログイン処理
     */
     public function login(LoginPostRequest $request)
     {
         //データの取得
         $datum = $request->validated();
         //
         //var_dump($datum); exit;
         //認証
         if (Auth::attempt($datum) === false) {
             return back()
                    ->withInput() //入力の保持
                    ->withErrors(['auth' => 'emailかパスワードに誤りがあります。',]) //エラーメッセージの出力
                    ;
         }
         //
         $request->session()->regenerate();
         return redirect()->intended('/task/list');
     }
}