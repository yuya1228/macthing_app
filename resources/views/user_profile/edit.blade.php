@extends('layouts.main')

@section('app_meanu')

@section('content')

    @if (session('update_massage'))
        <div class="create_message">
            {{ session('update_message') }}
        </div>
    @endif

    <h1 class="text-4xl py-10 font-mono text-center">プロフィール設定</h1>
    <div class="profile-create">
        <form action="{{ route('user_profile.update', ['user_profile' => $user->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <ul>
                <li>
                    <label for="name">ユーザーネーム</label>
                    <input type="text" name="name" value="{{ $user->name }}">
                </li>
                <li>
                    <label for="image"></label>
                    <input type="file" name="image" value="{{ $user->profile->image }}">
                </li>
                <li>
                    <label for="text">自己紹介</label>
                    <textarea name="text" cols="30" rows="10">{{ $user->profile->text }}</textarea>
                </li>
                <li>
                    <label for="age">年齢</label>
                    年齢:<input type="number" name="age" min="18" max="100"
                        value="{{ $user->profile->age }}">
                    <label for="hobby">趣味</label>
                    趣味:<input type="text" name="hobby" value="{{ $user->profile->hobby }}">
                </li>
            </ul>

            <input type="submit" value="プロフィール更新" class="bg-green-500 hover:bg-green-300 p-2 text-white rounded-md">
        </form>
    </div>

@endsection
