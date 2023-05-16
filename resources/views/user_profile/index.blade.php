@extends('layouts.main')
@section('app_menu')

@section('content')
    <main>
        <h1 class="text-4xl py-10 font-mono text-center">プロフィール一覧</h1>

        {{-- ログインしていたらユーザー名、それ以外はメッセージ --}}
        <div class="text-center">
            @if ($profile_user)
                <h2 class="text-center text-3xl font-mono">こんにちは{{ Auth::user()->name }}さん！</h2>
            @else
                <a href="{{ route('user_profile.create') }}"
                    class="text-2xl text-white hover:text-blue-300 bg-orange-400 first-line:rounded-md p-2 font-mono">新規登録はこちらからです＾＾</a>
            @endif
        </div>
        {{-- ここまで --}}

        {{-- フラッシュメッセージ --}}
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
        {{-- ここまで --}}

        <div class="flex-container">
            @auth
                @foreach ($users as $user)
                    {{-- 一覧ページからログインユーザーは除外する処理 --}}
                    @if ($user->profile && $user->profile->user_id !== Auth::user()->id)
                        <div class="flex-item">
                            <img src="{{ asset('storage/images/' . $user->profile->image) }}" class="profile-image">
                            <ul class="profile-info">
                                <li>
                                    名前:{{ $user->name }}
                                </li>
                                <li>
                                    自己紹介:
                                    {{ $user->profile->text }}
                                </li>
                                <li>
                                    趣味:{{ $user->profile->hobby }}</趣味:>
                                </li>
                                <li>
                                    年齢:{{ $user->profile->age }}
                                </li>
                                <li>
                                    性別:{{ $user->profile->gender->gender }}
                                </li>
                                <li class="mt-3">
                                    <a href="{{ route('user_profile.show', ['user_profile' => $user->id]) }}"
                                        class="bg-green-500 hover:bg-green-300 text-white p-3 rounded-md">プロフィールを確認する！</a>
                                </li>
                                @can('admin')
                                    <li>
                                        <form action="{{ route('user_profile.destroy', ['user_profile' => $user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 hover:bg-red-300 rounded-md p-3 mt-3">削除する</button>
                                        </form>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    @endif
                @endforeach
                {{-- ここまで --}}

                {{-- ログインしていないユーザーは全プロフィールを表示する。 --}}
            @else
                @foreach ($users as $user)
                    <div class="flex-item">
                        <img src="{{ asset('storage/images/' . $user->profile->image) }}" class="profile-image">
                        <ul class="profile-info">
                            <li>
                                名前:{{ $user->name }}
                            </li>
                            <li>
                                自己紹介:
                                {{ $user->profile->text }}
                            </li>
                            <li>
                                趣味:{{ $user->profile->hobby }}</趣味:>
                            </li>
                            <li>
                                年齢:{{ $user->profile->age }}
                            </li>
                            <li>
                                性別:{{ $user->profile->gender->gender }}
                            </li>
                            <li class="mt-3">
                                <a href="{{ route('user_profile.show', ['user_profile' => $user->id]) }}"
                                    class="bg-green-500 hover:bg-green-300 text-white p-3 rounded-md">プロフィールを確認する！</a>
                            </li>
                            @can('admin')
                                <li>
                                    <form action="{{ route('user_profile.destroy', ['user_profile' => $user->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-300 rounded-md p-3 mt-3">削除する</button>
                                    </form>
                                </li>
                            @endcan
                        </ul>
                    </div>
                @endforeach
            @endauth
        </div>
        {{-- ここまで --}}

        {{ $users->links('vendor.pagination.tailwind2') }}
    </main>
@endsection
