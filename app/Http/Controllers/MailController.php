<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Illuminate\Http\Request;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    // 指定ユーザーのメール送信画面
    public function recipientMail($id)
    {
        // UsersテーブルとMailsテーブルとのリレーション
        $mail = User::with('mails')->find($id);
        $user = User::with('mails')->find($id);
        return view('mail.recipient', compact('user', 'mail'));
    }

    // 指定ユーザーへ新規メール送信機能
    public function sendMail(MailRequest $request, $user_id, $id)
    {
        // 送信時にUsersテーブルからidを取得
        $user = User::find($user_id);
        $sender = Auth::user();

        // メールを送信
        $mail = new Mail();
        $mail->sender_id = $sender->id;
        $mail->user_id = $user->id;
        $mail->message = $request->input('message');
        $mail->subject = $request->input('subject');
        $mail->reply = 0;

        if (!is_null($id)) {
            $original_mail = Mail::find($id);
            if ($original_mail) {
                $mail->reply_mail_id = $original_mail->id;
            }
        }
        $mail->save();
        return redirect()->route('mail.recipient', ['user' => $user_id])->with('mail_message', 'メールを送信しました。');
    }

    // 返信用の処理
    public function store(MailRequest $request, $sender_id,$id)
    {
        $user = Auth::user();
        $sender = User::with('mails')->find($sender_id);
        $subject = $request->subject;
        $reply_mail = Mail::find($id);

        // 返信用のメールを作成
        $mail = new Mail();
        $mail->user_id = $sender->id;
        $mail->sender_id = $user->id;
        $mail->subject = $subject;
        $mail->message = $request->input('message');
        $mail->reply = 0;
        $mail->reply_mail_id = $reply_mail->id;
        $mail->save();

        // 返信用メールが送信されたらreplyカラムに1を入れて更新する。
        $reply_mail->reply = 1;
        $reply_mail->save();

        return redirect()->route('mail.box')->with('mail_message', '送信しました。');
    }

    // ログインユーザーのメールボックス画面
    public function mailBox()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $mails = Mail::with('user')->where('user_id', $user_id)->get();
        $senders = Mail::with('sender')->where('user_id', $user_id)->where('reply', false)->get();
        return view('mail.box', compact('mails', 'senders'));
    }

    /**
     * Display the specified resource.
     */
    // 受信メール詳細画面
    public function show(string $id)
    {
        // 送信者を取得し、ログインしているユーザーのみのデータを取得する。
        // 条件に一致した最初のデータを取得する。
        $mail = Mail::with('user')->where('user_id', Auth::user()->id)->first();
        $sender = Mail::with('sender')->where('user_id', Auth::user()->id)->where('id', $id)->first();
        return view('mail.show', compact('sender', 'mail'));
    }

    // メール削除機能
    public function destroy($id)
    {
        $mail = Mail::find($id);
        $mail->delete();
        return redirect()->route('mail.box');
    }
}