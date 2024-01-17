<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
// 買い物リスト管理システム
Route::get('/', [AuthController::class, 'index'])->name('front.index');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user/register', [UserController::class, 'index']);
Route::post('/user/register', [UserController::class, 'register']);
//認可処理
Route::middleware(['auth'])->group(function () {
    Route::prefix('/task')->group(function() {
        Route::get('/list', [TaskController::class, 'list']);
        Route::post('/register', [TaskController::class, 'register']);
        Route::post('/complete/{task_id}', [TaskController::class, 'complete'])->whereNumber('task_id')->name('complete');
    });
    //
    Route::get('/logout', [AuthController::class, 'logout']);
    
});


