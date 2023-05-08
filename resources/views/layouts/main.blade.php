<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>マッチングサイト</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>

<body>
<header>
    @yield('app_manu')
    <h1 class="text-center text-6xl font-mono py-32 text-white hover:text-blue-500" >マッチングアプリ</h1>
 <div id="app">
        <button type="button" class="menu-btn" v-on:click="open=!open">☰</button>
        <div class="menu" v-bind:class="{'is-active':open}">
            <li><a href="#">Menu</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="#">Menu</a></li>
        </div>
    </div>
</header>
@yield('content')
</body>

</html>
