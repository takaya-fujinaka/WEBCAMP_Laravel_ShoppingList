<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRegisterPostRequest;
use App\Models\shopping_list as shopping_listModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Completed_shopping_list as Completed_shopping_listModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * タスク一覧ページを表示する
     * @return\Illuminate\View\View
     */
     public function list()
     {
         // 1page辺りの表示アイテム数を設定
         $per_page = 3;
         //一覧の取得
         $list = shopping_listModel::where('user_id', Auth::id())
                                   ->orderBy('created_at')
                                   ->paginate($per_page);
         //$sql = shopping_listModel::where('user_id', Auth::id())->toSql();
         //echo "<pre>\n"; var_dump($sql, $list); exit;
         return view('task.list', ['list' => $list]);
     }
     public function getshopping_listModel($task_id) {
      // task_idのレコードを取得する
      $task = shopping_listModel::find($task_id);
      if ($task === null) {
              return null;
     }
      // 本人以外のタスクならNGとする
      if ($task->user_id !== Auth::id()) {
         return null;
      }
      //
      return $task;
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
      /**
       * タスクの完了
       */
       public function complete(Request $request, $task_id)
       {
        /* タスクを完了テーブルに移動させる*/
        try {
         //トランザクション開始
         DB::beginTransaction();
         //task_idのレコードを取得する
         $task = $this->getshopping_listModel($task_id);
         if ($task === null) {
          //task_idが不正なのでトランザクション終了
          throw new \Exception('');
         }
        //var_dump($task->toArray()); exit;
        //tasks側を削除する
        $task->delete();
        //completed_tasks側にinsertする
        $dask_datum = $task->toArray();
        unset($dask_datum['created_at']);
        unset($dask_datum['updated_at']);
        $r = Completed_shopping_listModel::create($dask_datum);
        if ($r === null) {
         //insertで失敗したのでトランザクション終了
        throw new \Exception('');
        }
        //echo '処理成功'; exit;
        //トランザクション終了
        DB::commit();
        //完了メッセージ出力
        $request->session()->flash('front.task_completed_success', true);
        } catch(\Throwable $e) {
         var_dump($e->getMessage()); exit;
         //トランザクション異常終了
         DB::rollBack();
         //完了失敗メッセージ出力
         $request->session()->flash('front.task_completed_failure', true);
        }
        
        //一覧に遷移する
        return redirect('/task/list');
       }
       
       /**
        * タスクの削除
        */
        public function delete(Request $request, $task_id) {
         //task_idのレコードを取得する
         $task = $this->getshopping_listModel($task_id);
         //タスクを削除する
         if ($task !== null) {
          $task->delete();
          $request->session()->flash('front.task_delete_success', true);
         }
         //一覧に遷移する
         return redirect('/task/list');
        }
}