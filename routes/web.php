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
// 受信メールの詳細画面と送受信の削除機能
Route::resource('mail', MailController::class)->only(['show', 'destroy']);
Route::post('/mail/store/{sender_id}/{id}', [MailController::class, 'store'])->name('mail.store');
// 指定ユーザー新規メール送信画面
Route::get('/mail/new_message/{user}', [MailController::class, 'recipientMail'])->name('mail.recipient');
// 指定ユーザー新規メール送信機能
Route::post('/mail/sendMail/{user_id}/{id}', [MailController::class, 'sendMail'])->name('mail.sendMail');
// ログインユーザーのメール受信ボックス画面
Route::get('mail/message/box', [MailController::class, 'mailBox'])->name('mail.box');
// 送信メールボックス
Route::get('/mail/message/sender_box', [MailController::class, 'senderBox'])->name('mail.sender_box');
// 送信メール詳細確認
Route::get('mail/message/{id}', [MailController::class, 'senderBox_show'])->name('mail.sender_box_show');
// 送信メール削除
Route::delete('mail/message/{id}', [MailController::class, 'sender_destroy'])->name('mail.sender_destroy');
// メール機能ここまで

// admin専用ユーザー作成画面
Route::get('admin/admin_create', [AdminController::class, 'create'])->name('admin.create');
// ユーザー作成処理
Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
// 管理者用受信ページ
Route::get('admin/mail', [AdminController::class, 'admin_mail'])->name('admin.mail');
// 管理者用受信メール詳細画面
Route::get('admin/mail/{id}',[AdminController::class,'admin_mail_show'])->name('admin.show');

// adminユーザーに問い合わせページ
Route::get('admin/sender/mail', [AdminController::class, 'admin_sender_mail'])->name('admin.sender_mail');
// adminユーザーへのメール送信機能
Route::post('admin/mail/{mail}', [AdminController::class, 'admin_sender'])->name('admin.sender');
// 管理者の受信メール削除機能
Route::delete('admin/mail/{id}', [AdminController::class, 'admin_mail_delete'])->name('admin.mail_delete');
// 管理者の返信ボックス
Route::get('admin/sender/box',[AdminController::class,'admin_mail_box'])->name('admin.mail_box');
// 返信機能
Route::post('admin/mail/{sender_id}/{id}',[AdminController::class,'sender_mail'])->name('admin.sender.mail');
// 管理者返信メール削除
Route::delete('admin/sender_mail/{id}',[AdminController::class,'sender_mail_delete'])->name('sender.delete');
// ここまで

// 認証機能
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
// ここまで
