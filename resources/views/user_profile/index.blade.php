@extends('layouts.main')
@section('app_menu')

@section('content')
    <main>
        <h1 class="text-4xl py-10 font-mono text-center">プロフィール一覧</h1>
        <div class="flex-container">
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
                    </ul>
                </div>
            @endforeach
        </div>
    </main>
@endsection
