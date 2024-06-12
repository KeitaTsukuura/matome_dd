<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>まとめスパッタリー!</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h1>{{ $gear->title }}</h1>
        </x-slot>

        <div class="container mt-5">
            <div class="content mb-4">
                <div class="content_gear card p-3">
                    <h3 class="card-title">本文</h3>
                    <p class="card-text">{{ $gear->body }}</p>
                    <div class="text-center mb-3">
                        <img src="{{ $gear->image_url }}" class="img-fluid" alt="画像が読み込めません."/>
                    </div>
                    <p class='user card-text'>投稿者: {{ $gear->user->name }}</p>
                    <p class="card-text">投稿日時: {{ $gear->created_at }}</p>
                </div>
            </div>
            <div class="edit mb-4 text-center">
                <a href="/gears/{{ $gear->id }}/edit" class="btn btn-primary">編集</a>
            </div>
            
            <div class="comments mb-5">
                <h2 class="text-center mb-4">コメント一覧</h2>
                @foreach ($gear->gear_comments as $comment)
                    <div class="comment card mb-3 p-3">
                        <p class="card-text">{{ $comment->body }}</p>
                        <p class='user card-text'>投稿者: {{ $comment->user->name }}</p>
                        <p class="card-text">投稿日時: {{ $comment->created_at }}</p>
                        @auth
                        <form action="/gear_comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="deleteComment({{ $comment->id }})">削除</button>
                        </form>
                        @else
                        <p class="text-danger">コメントを削除するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
                        @endauth
                    </div>
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
            <form action="/gear_comments" method="POST" class="mb-5">
                @csrf
                <div class="comment form-group">
                    <h2>コメントを追加</h2>
                    <textarea name="comment[body]" class="form-control" placeholder="コメントを書いてね">{{ old('comment.body') }}</textarea>
                    <input type="hidden" name="gear_id" value="{{ $gear->id }}">
                    @if ($errors->has('comment.body'))
                        <p class="text-danger">{{ $errors->first('comment.body') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">コメントする</button>
            </form>
            @else
            <p class="text-center">コメントを追加するには<a href="{{ route('login') }}" class="text-primary">ログイン</a>してください。</p>
            @endauth

            <div class="text-center mt-4">
                <a href="/gears/index" class="btn btn-secondary">戻る</a>
            </div>
        </div>
    </x-app-layout>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
