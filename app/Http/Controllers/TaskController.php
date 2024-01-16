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
         //一覧の取得
         $list = shopping_listModel::get();
         //$sql = shopping_listModel::where('user_id', Auth::id())->toSql();
         //echo "<pre>\n"; var_dump($sql, $list); exit;
         return view('task.list', ['list' => $list]);
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