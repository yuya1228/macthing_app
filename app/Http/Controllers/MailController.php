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
    public function store(MailRequest $request, $sender_id, $id)
    {
        $user = Auth::user();
        $sender = User::with('mails')->find($sender_id);
        $subject = $request->subject;

        // 返信用のメールを作成
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
            if($reply_mail){
            $reply_mail->reply = 1;
            $reply_mail->save();
        }

        return redirect()->route('mail.box')->with('mail_message', '送信しました。');
    }

    // 返信メール確認ページ
    public function senderBox()
    {
        $user_id = Auth::user()->id;
        $senders = Mail::with('sender')->where('sender_id',$user_id)->get();

        return view('mail.sender_box',compact('senders'));
    }

    // 返信メール詳細ページ
    public function senderBox_show($id)
    {
        $user_id = Auth::user()->id;
        $sender = Mail::with('sender')->where('sender_id', $user_id)->first();
        return view('mail.sender_box_show',compact('sender'));
    }

    // ログインユーザーの受信メールボックス画面
    public function mailBox()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $mails = Mail::with('user')->where('user_id', $user_id)->withTrashed()->get();
        $senders = $mails->where('reply', false);
        return view('mail.box', compact('mails', 'senders'));
    }

    /**
     * Display the specified resource.
     */
    // 受信メール詳細画面
    public function show(string $id)
    {
        $user_id = Auth::user()->id;
        // 送信者を取得し、ログインしているユーザーのみのデータを取得する。
        // 条件に一致した最初のデータを取得する。
        $mail = Mail::with('user')->withTrashed()->where('user_id', $user_id)->first();
        $sender = Mail::with('sender')->withTrashed()->where('user_id', $user_id)->first();
        return view('mail.show', compact('sender', 'mail'));
    }

    // 受信メール削除機能
    public function destroy($id)
    {
        $mail = Mail::onlyTrashed()->find($id);
        if($mail){
            if($mail->trashed()){
                $mail->forceDelete();
            }else{
                $mail->delete();
            }
        }

        return redirect()->route('mail.box');
    }

    // 送信メール論理削除
    public function sender_destroy($id)
    {
        $mail = Mail::find($id);
        if($mail->sender_id === Auth::user()->id){
            $mail->delete();
        }
        return redirect()->route('mail.sender_box');
    }
}
