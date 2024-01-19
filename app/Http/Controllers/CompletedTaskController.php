<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Completed_shopping_list as Completed_shopping_listModel;
use Illuminate\Support\Facades\Auth;

class CompletedTaskController extends Controller
{
    //メソッド
    public function list()
    {
        // 1page辺りの表示アイテム数を設定
         $per_page = 3;
         //一覧の取得
         $completed_shopping_list = Completed_shopping_listModel::where('user_id', Auth::id())
                                   ->orderBy('created_at')
                                   ->paginate($per_page);
        
        return view('task.completed_shopping_list', ['completed_shopping_list' => $completed_shopping_list]);
    }
}