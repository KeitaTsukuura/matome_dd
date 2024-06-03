<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>まとめスパッタリー!</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <x-app-layout>
        <x-slot name="header">
            index
        </x-slot>
        <body>
            <h1>まとめスパッタリー!</h1>
            <div class='gears'>
                @foreach ($gears as $gear)
                    <div class'gear'>
                        <h2 class='title'>
                            <a href="/gears/{{ $gear->id }}">{{ $gear->title }}</a>
                        </h2>
                        <p class='body'>{{ $gear->body }}</p>
                        <div>
                            <img src="{{ $gear->image_url }}" alt="画像が読み込めません" />
                        </div>
                        <p class='user'>投稿者: {{ $gear->user->name }}</p>
                        @auth
                        <form action="/gears/{{ $gear->id }}" id="form_{{ $gear->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deleteGear({{ $gear->id }})">削除</button>
                        </form>
                        @else
                        <p>投稿を削除するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
                        @endauth
                    </div>
                @endforeach
                </div>
                <div class='paginate'>
                    {{ $gears->links() }}
                </div>
            </div>
            @auth
            <a href='/gears/create'>ギアを投稿</a>
            @else
            <p>ギアを投稿するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
            @endauth
            
            <script>
                function deleteGear(id) {
                    'use strict'
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
            
            <div class="user_name">
                @if (Auth::check())
                <p>ログインユーザー: {{ Auth::user()->name }}</p>
                @else
                <p>ログインしていません</p>
                @endif
            </div>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>