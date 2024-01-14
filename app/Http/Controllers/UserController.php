<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterPostRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel

class UserController extends Controller
{
    /**
     * トップページを表示する
     * @return\Illuminate\View\View
     */
     public function index()
     {
         return view('/register');
     }
     public function register(UserRegisterPostRequest $request)
     {
         //validate済みのデータの取得
         $datum = $request->validated();
         //パスワードのHash化
         $datum['password'] = Hash::make($datum['password']);
         //UserテーブルへのINSERT
         try{
             $r = UserModel::create($datum);
         }catch(\Throwable $e) {
             echo $e->getMessage();
             exit;
         }
         //メッセージ
         //会員登録成功
         $request->session()->flash('front.user_register_success', true);
         //一覧に遷移する
         return redirect('/');
     }
}