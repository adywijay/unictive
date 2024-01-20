<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BaseUser\BaseUserControllerWeb;
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

Route::get('/', function () {
    return view('welcome');
});
/* Route function login For User */
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

/* Route function logout For User */
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('base-user')->group(

    function () {
        Route::get('/', [BaseUserControllerWeb::class, 'index'])->name('dashboard_bu');
        Route::get('/tes/logic', [BaseUserControllerWeb::class, 'tesLogic'])->name('view_test');
        Route::post('/tes/logic/do', [BaseUserControllerWeb::class, 'doRunnLoop'])->name('runn_loop');
        Route::get('/hobby/add', [BaseUserControllerWeb::class, 'addHobby'])->name('view_add_hobby');
        Route::get('/hobby/getlist', [BaseUserControllerWeb::class, 'getListHobby'])->name('get_hobby');
        Route::post('/hobby/do_insert', [BaseUserControllerWeb::class, 'doActionInsertHobby'])->name('do_add_hobby');
        Route::get('/member/add', [BaseUserControllerWeb::class, 'addMember'])->name('view_add_member');
        Route::get('/member/cek_email', [BaseUserControllerWeb::class, 'checkExixstEmail'])->name('cek_email_member');
        Route::post('/member/do_insert', [BaseUserControllerWeb::class, 'doActionInsertMember'])->name('do_add_member');
    }
);
