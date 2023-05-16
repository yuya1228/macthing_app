@extends('layouts.main')
@section('app_menu')

@section('content')

    @if (session('comment'))
        <div class="create-message">
            {{ session('comment') }}
        </div>
    @else
        <div>
            <p class="text-white bg-red-300 rounded-md p-2 m-5 inline-block">登録に失敗しました。</p>
        </div>
    @endif

    <h1 class="text-4xl py-10 font-mono text-center">ユーザー新規登録</h1>
    <div class="profile-create">
        <form action="{{ route('user_profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <ul>
                <li><input type="text" name="name" placeholder="プロフィール名"></li>
                @error('name')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                <li><input type="file" name="image"></li>
                @error('image')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                <li><input type="email" name="email" placeholder="メールアドレス"></li>
                @error('email')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                <li><input type="password" name="password" placeholder="パスワード"></li>
                @error('password')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                <li>
                    <textarea name="text" cols="30" rows="10" placeholder="自己紹介"></textarea>
                </li>
                @error('text')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                <li>
                    性別:<label for="gender_id">男性</label>
                    <input type="radio" name="gender_id" value="1">
                    <label for="gende_id">女性</label>
                    <input type="radio" name="gender_id" value="2">
                    @error('gender_id')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                </li>
                <li>
                    年齢:<input type="number" name="age" min="18" max="100">
                    @error('age')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                <li>趣味:<input type="text" name="hobby"></li>
                @error('hobby')
                    <li class="error-message">{{ $message }}</li>
                @enderror
                </li>
            </ul>
            <input type="submit" value="ユーザー作成" class="bg-green-500 hover:bg-green-300 p-2 text-white rounded-md">
        </form>
    </div>
@endsection
