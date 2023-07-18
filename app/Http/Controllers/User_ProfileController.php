<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Mail;
use App\Models\Profile;

class User_ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile_user = Auth::user();
        $users = User::with('profile.gender')->with('mails')->paginate(6);
        return view('user_profile.index', compact('users','profile_user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request)
    {

        $password = $request->input('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $users = User::create([
            'name' => $request->input('name'),
            'password' => $hashedPassword,
            'email' => $request->input('email'),
        ]);

        // 画像の保存
        $image = $request->file('image');
        $img = $image->getClientOriginalName();
        $image->storeAs('public/images', $img);
        // ここまで

        $users->profile()->create([
            'image' => $img,
            'text' => $request->input('text'),
            'hobby' => $request->input('hobby'),
            'age' => $request->input('age'),
            'gender_id'=>$request->input('gender_id'),
        ]);

        return redirect()->route('user_profile.create', compact('users'))->with('comment', 'ユーザー登録をしました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::with('profile.gender')->find($id);
        return view('user_profile.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        return view('user_profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = Auth::user();

        $users->profile->update([
            'name'=>$request->input('name'),
            'image'=>$request->input('image'),
            'text'=>$request->input('text'),
            'age'=>$request->input('age'),
            'hobby'=>$request->input('hobby'),
        ]);


        return redirect()->route('user_profile.edit',compact('users'))->with('update_message','更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);

        if ($users) {
            $users->profile()->delete();

            $users->delete();

            return redirect()->route('user_profile.index')->with('success', '削除が完了しました。');
        } else {
            return redirect()->route('user_profile.index')->with('error', '削除対象が見つかりませんでした。');
        }
    }
}
