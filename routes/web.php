<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User_ProfileController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// マッチングアプリ
Route::resource('user_profile', User_ProfileController::class);

// メール機能
Route::resource('mail',MailController::class)->only(['show','destroy']);
Route::post('/mail/store/{sender_id}/{id}',[MailController::class,'store'])->name('mail.store');
// 指定ユーザーメール送信画面
Route::get('/message/{user}',[MailController::class,'recipientMail'])->name('mail.recipient');
// 指定ユーザーメール送信機能
Route::post('/message/sendMail/{user_id}/{id}',[MailController::class,'sendMail'])->name('mail.sendMail');
// ログインユーザーのメール受信ボックス画面
Route::get('box',[MailController::class,'mailBox'])->name('mail.box');

// admin専用画面
Route::get('admin/admin_create',[AdminController::class,'create'])->name('admin.create');
Route::post('admin/store',[AdminController::class,'store'])->name('admin.store');
// ここまで

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
