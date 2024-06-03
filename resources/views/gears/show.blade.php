<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>まとめスパッタリー!</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            gears.show
        </x-slot>

        <h1 class="title">
            {{ $gear->title }}
        </h1>
        <div class="content">
            <div class="content_gear">
                <h3>本文</h3>
                <p>{{ $gear->body }}</p>
                <div>
                    <img src="{{ $gear->image_url }}" alt="画像が読み込めません."/>
                </div>
                <p class='user'>投稿者: {{ $gear->user->name }}</p>
                <p>投稿日時: {{ $gear->created_at }}</p>
            </div>
        </div>
        <div class="edit">
            <a href="/gears/{{ $gear->id }}/edit">編集</a>
        </div>
        <div class="footer">
            <a href="/gears/index">戻る</a>
        </div>
    </x-app-layout>
</body>
</html>
