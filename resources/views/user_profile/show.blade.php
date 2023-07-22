@extends('layouts.main')

@section('app_menu')

@section('content')
    <main>
        <h1 class="text-4xl py-10 font-mono text-center">プロフィール詳細</h1>
        <div class="profile">
            <img src="{{ asset('storage/images/' . $users->profile->image) }}" class="profile-image">
            <ul class="profile-info">
                <li>
                    名前:{{ $users->name }}
                </li>
                <li>
                    自己紹介:
                    {{ $users->profile->text }}
                </li>
                <li>
                    性別：{{ $users->profile->gender->gender }}
                </li>
                <li>
                    趣味:{{ $users->profile->hobby }}
                </li>
                <li>
                    年齢:{{ $users->profile->age }}
                </li>
                @can('admin')
                    <li>
                        <form action="{{ route('user_profile.destroy', ['user_profile' => $users->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-300 rounded-md p-3 mt-3">削除する</button>
                        </form>
                    </li>
                @endcan
                <li class="mt-3 p-2 bg-blue-500 hover:bg-blue-300 inline-block rounded-md">
                    <a href="{{ route('mail.recipient', ['user' => $users->id]) }}">
                        メッセージを送る。
                    </a>
                </li>
                <button class="mt-5"><a href="{{ route('user_profile.index') }}"
                        class="bg-green-500 hover:bg-green-300 p-3 text-white rounded-md ">一覧に戻る</a></button>
            </ul>
        </div>
    </main>
@endsection
