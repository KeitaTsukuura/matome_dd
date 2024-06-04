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
        
        <div class="comments">
            <h2>コメント一覧</h2>
            @foreach ($gear->gear_comments as $comment)
                <div class="comment">
                    <p>{{ $comment->body }}</p>
                    <p class='user'>投稿者: {{ $comment->user->name }}</p>
                    <p>投稿日時: {{ $comment->created_at }}</p>
                </div>
                @auth
                <form action="/gear_comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteComment({{ $comment->id }})">削除</button>
                </form>
                @else
                <p>コメントを削除するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
                @endauth
            @endforeach
        </div>
        <script>
            function deleteComment(id) {
                'use strict';
                    
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        @auth
        <form action="/gear_comments" method="POST">
            @csrf
            <div class="comment">
                <h2>コメントを追加</h2>
                <textarea name="comment[body]" placeholder="コメントを書いてね">{{ old('comment.body') }}</textarea>
                <input type="hidden" name="gear_id" value="{{ $gear->id }}">
                @if ($errors->has('comment.body'))
                    <p class="comment_error" style="color:red">{{ $errors->first('comment.body') }}</p>
                @endif
            </div>
            <input type="submit" value="コメントする"/>
        </form>
        @else
        <p>コメントを追加するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
        @endauth

        <div class="footer">
            <a href="/gears/index">戻る</a>
        </div>
    </x-app-layout>
</body>
</html>