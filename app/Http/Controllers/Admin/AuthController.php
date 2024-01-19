<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * トップページを表示する
     * @return\Illuminate\View\View
     */
     public function index()
     {
         return view('admin.index');
     }
     /**
      * ログイン処理
      */
      public function login(AdminPostRequest $request)
      {
       
       //validate済み
       
       //データの取得
       $datum = $request->validated();
       //var_dump($datum); exit;
       
       //認証
       if (Auth::attempt($datum) === false) {
        return back()
               ->withInput() //入力の保持
               ->withErrors(['auth' => 'ログインIDかパスワードに誤りがあります。',]) //エラーメッセージの出力
               ;
       }
      }
      //
      $request->session()->regenerate();
      return redirect()->intended('/task/list');
      
     
    
}