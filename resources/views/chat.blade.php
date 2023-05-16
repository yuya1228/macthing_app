@extends('layouts.main')
@section('app_menu')

@section('content')
    <div class="container">
        <div class="row" id="chat">
            <h1>チャットルーム</h1>
            <div class="offset-4 col-md-4">
                <li class="list-group-item active">Chat</li>
                <ul class="list-group">
                    <message v-for="value in chat.message">
                        @{{ value }}
                    </message>
                </ul>
                <input type="text" class="form-control" placeholder="Type your message here.." v-model='message'
                    @keyup.enter='send'>
            </div>
        </div>
    </div>
@endsection
