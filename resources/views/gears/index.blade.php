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