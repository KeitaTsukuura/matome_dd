<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>まとめスパッタリー!</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center">投稿を編集!</h2>
    </x-slot>

    <div class="container mt-4">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="post[title]" placeholder="タイトル" value="{{ $post->title }}">
                <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>

            <div class="form-group">
                <label for="body">本文</label>
                <textarea class="form-control" id="body" name="post[body]" placeholder="スパッタリーのことを書いてね">{{ $post->body }}</textarea>
                <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>

            <button type="submit" class="btn btn-primary">保存</button>
        </form>

        <div class="mt-4">
            <a href="/" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</x-app-layout>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
