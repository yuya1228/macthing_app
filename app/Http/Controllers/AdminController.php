<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mail;
use App\Http\Requests\MailRequest;
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

        // 管理者によるユーザー作成
        $users = User::create([
            'name' => $request->input('name'),
            'password' => $hashedPassword,
            'email' => $request->input('email'),
            'role' => $request->input('role')
        ]);

        $image = $request->file('image');
        $img = $image->getClientOriginalName();
        $image->storeAs('public/images', $img);

        // ユーザー作成後にprofileを作成
        $users->profile()->create([
            'image' => $img,
            'text' => $request->input('text'),
            'hobby' => $request->input('hobby'),
            'age' => $request->input('age'),
            'gender_id' => $request->input('gender_id'),
        ]);

        return redirect()->route('admin.create', compact('users'))->with('create_message', 'ユーザー作成しました。');
    }


// メール機能
    // 管理者用メールボックス
    public function admin_mail()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $mails = Mail::with('user')->where('user_id', $user_id)->withTrashed()->get();
        $senders = $mails->where('reply', false);
        return view('admin.mail', compact('senders'));
    }

    // 管理者用返信メールボックス
    public function admin_mail_box()
    {
        $user_id = Auth::user();
        $user = $user_id->id;
        $mails = Mail::with('user')->where('sender_id',$user)->where('reply',false)->get();

        return view('admin.mail_box',compact('mails'));
    }

    // 管理者用受信メール詳細画面
    public function admin_mail_show($id)
    {
        $user = Auth::user()->id;
        $mail = Mail::with('user')->where('user_id', $user)->find($id);
        return view('admin.show', compact('mail'));
    }

    // お問い合わせページ
    public function admin_sender_mail()
    {
        $admin_user = User::where('role', '>=', 90)->where('role', '<=', 100)->first();
        return view('admin.sender_mail', compact('admin_user'));
    }

    // 管理者へのお問い合わせ機能
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

    // 受信メールの返信機能
    public function sender_mail(MailRequest $request,$sender_id,$id)
    {
        $user = Auth::user();
        $sender = User::with('mails')->find($sender_id);
        $subject = $request->subject;

        $mail = new Mail();
        $mail->user_id = $sender->id;
        $mail->sender_id = $user->id;
        $mail->subject = $subject;
        $mail->message = $request->input('message');
        $mail->reply = 0;
        $mail->reply_mail_id = $id;
        $mail->save();

        // 返信用メールが送信されたら元のメールを更新し、返信フラグを1に変更する。
        $reply_mail = Mail::find($id);
        if ($reply_mail) {
            $reply_mail->reply = 1;
            $reply_mail->save();
        }
        return redirect()->route('admin.box')->with('mail_message', '送信しました。');
    }

    // 管理者宛のメール削除機能
    public function admin_mail_delete($id)
    {
        $mail = Mail::withTrashed()->find($id);
        if ($mail) {
            if ($mail->trashed()) {
                $mail->forceDelete();
            } else {
                $mail->delete();
            }
        }
        return redirect()->route('admin.mail');
    }

    // 管理者返信メール削除
    public function sender_mail_delete($id)
    {
        $user_id = Auth::user()->id;
        $mail = Mail::with('user')->where('sender_id',$user_id)->find($id);
        if($mail){
            if($mail->trashed()){
                $mail->forceDelete();
            }else{
                $mail->delete();
            }
        }
        return redirect()->route('admin.mail_box');
    }
// メール機能はここまで
}
