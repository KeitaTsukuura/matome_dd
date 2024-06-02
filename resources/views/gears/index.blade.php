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
                        <p class='user'>投稿者: {{ $gear->user->name }}</p>
                    </div>
                @endforeach
                </div>
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            </div>
            <div class="user_name">
                @if (Auth::check())
                <p>ログインユーザー: {{ Auth::user()->name }}</p>
                @else
                <p>ログインしていません</p>
                @endif
            </div>
        </body>
    </x-app-layout>
</html>