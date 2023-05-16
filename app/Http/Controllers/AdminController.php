<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function  create()
    {
        return view('admin.admin_create');
    }

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
}
