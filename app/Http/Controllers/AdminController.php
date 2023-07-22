<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mail;
use Termwind\Components\Dd;

class AdminController extends Controller
{
    public function  create()
    {
        return view('admin.admin_create');
    }

    // ユーザー作成機能
    public function store(AdminUserRequest $request)
    {
        $password = $request->input('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $users = User::create([
            'name' => $request->input('name'),
            'password' => $hashedPassword,
            'email' => $request->input('email'),
            'role' => $request->input('role')
        ]);

        $image = $request->file('image');
        $img = $image->getClientOriginalName();
        $image->storeAs('public/images', $img);


        $users->profile()->create([
            'image' => $img,
            'text' => $request->input('text'),
            'hobby' => $request->input('hobby'),
            'age' => $request->input('age'),
            'gender_id' => $request->input('gender_id'),
        ]);

        return redirect()->route('admin.create', compact('users'))->with('create_message', 'ユーザー作成しました。');
    }

    // 管理者用メールボックス
    public function admin_mail()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $mails = Mail::with('user')->where('user_id', $user_id)->withTrashed()->get();
        return view('admin.mail', compact('mails'));
    }

    public function admin_sender_mail()
    {
        $admin_user = User::where('role', '>=', 90)->where('role', '<=', 100)->first();
        return view('admin.sender_mail', compact('admin_user'));
    }

    public function admin_sender(Request $request, $mail)
    {
        $user = User::where('role', '>=', 90)->where('role', '<=', 100)->first();
        $sender = Auth::user();

        $mail_sender = new Mail();
        $mail_sender->user_id = $user->id;
        $mail_sender->sender_id = $sender->id;
        $mail_sender->subject = $request->input('subject');
        $mail_sender->message = $request->input('message');
        $mail_sender->reply = 0;
        $mail_sender->reply_mail_id = null;
        $mail_sender->save();

        return redirect()->route('admin.sender_mail')->with('mail_message', 'メールを送信しました。');
    }
}
