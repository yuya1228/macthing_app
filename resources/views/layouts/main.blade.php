<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>マッチングサイト</title>
    <link rel="stylesheet" href="{{ asset('css/mail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_mail.css') }}">
    @vite(['resources/css/app.css', 'resources/js/main.js'])
    <script src="{{ asset('js/mail.js') }}" defer></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>

<body>
    <div class="html_position">
    <header>
        @yield('app_manu')
        <h1 class="text-center text-6xl font-mono py-32 text-white hover:text-blue-500"><a
                href="{{ route('user_profile.index') }}">マッチングアプリ</a></h1>
        {{-- バーガーメニュー --}}
        <div id="app">
            <button type="button" class="menu-btn" v-on:click="open=!open">☰</button>
            <div class="menu" v-bind:class="{'is-active':open}">
                <li><a href="{{ route('user_profile.index') }}">一覧画面</a></li>
                <li><a href="{{ route('login') }}">ログイン</a></li>
                <li><a href="{{ route('user_profile.create') }}">新規登録</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li><a href="#"><input type="submit" value="ログアウト"></a></li>
                </form>
                @can('admin')
                    <li><a href="{{ route('admin.create') }}">ユーザー作成</a></li>
                @endcan

                @php
                    $user = Auth::user();
                @endphp

                @if ($user && $user->profile)
                    <form action="{{ route('user_profile.edit', ['user_profile' => $user->profile->id]) }}"
                        method="GET">
                        @csrf
                        <li><a href="#"><input type="submit" value="プロフィール編集"></a>
                        </li>
                    </form>
                @else
                    <a href="{{ route('user_profile.create') }}"
                        class="text-orange-500 hover:text-red-300">プロフィールが存在しません</a>
                @endif
                @if ($user && $user->profile && $user->role <= 89)
                    <a href="{{ route('mail.box') }}">メール受信ボックス</a>
                @elseif($user && $user->profile && $user->role >= 90)
                <li><a href="{{ route('admin.mail') }}">管理者メールボックス</a></li>
                @endif
                @if ($user && $user->profile && $user->role <= 89)
                    <a href="{{ route('mail.sender_box') }}">メール送信ボックス</a>
                    @elseif ($user && $user->profile && $user->role >= 90)
                    <a href="{{ route('admin.mail_box') }}">管理者返信メールボックス</a>
                @endif
            </div>
        </div>
        {{-- ここまで --}}
    </header>
    @yield('content')
    <footer>
        <ul class="footer_menu">
            <li><a href="{{ route('admin.sender_mail') }}">-お問い合わせメール</a></li>
        </ul>
        <p class="copyright">© 2023 Example Inc. All Rights Reserved.</p>
    </footer>
    </div>
</body>
</html>
