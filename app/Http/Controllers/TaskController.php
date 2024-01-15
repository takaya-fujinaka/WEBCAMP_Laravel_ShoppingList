<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRegisterPostRequest;
use App\Models\shopping_list as shopping_listModel;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * タスク一覧ページを表示する
     * @return\Illuminate\View\View
     */
     public function list()
     {
         return view('task.list');
     }
     /**
      * タスクの新規登録
      */
      public function register(TaskRegisterPostRequest $request)
      {
          //validate済みのデータの取得
          $datum = $request->validated();
          //var_dump($datum);
          //
          //user = Auth::user();
          //$id = Auth::id();
          //user_idの追加
          $datum['user_id'] = Auth::id();
          //テーブルへのINSERT
          try {
              $r = shopping_listModel::create($datum);
          } catch(\Throwable $e) {
              echo $e->getMessage();
              exit;
          }
          //買うもの登録成功
          $request->session()->flash('front.task_register_success', true);
          //
          return redirect('/task/list');
          
      }
}