<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>まとめスパッタリー!</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
    
<x-app-layout>
    <x-slot name="header">
        <h1>まとめスパッタリー!</h1>
    </x-slot>
    <body>
        <div class='container'>
            <div class='text-center my-4'>
                <a href="/gears/index" class='btn btn-lg btn-outline-primary'>みんなのギアはこちら</a>
            </div>
            <div class='text-center my-4'>
                <form action="/posts/search" method="GET" class="form-inline justify-content-center">
                    @csrf
                    <input type="text" name="keyword" placeholder="検索キーワードを入力" class="form-control mr-2">
                    <button type="submit" class="btn btn-primary">検索</button>
                </form>
            </div>
            <div class='row'>
                @foreach ($posts as $post)
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <h2 class='card-title'>
                                    <a href="/posts/{{ $post->id }}" class="fs-3 text-primary">{{ $post->title }}</a>
                                </h2>
                                <a href="/categories/{{ $post->category->id }}" class="badge badge-secondary">{{ $post->category->name }}</a>
                                <p class='card-text mt-2'>{{ $post->body }}</p>
                                <p class="card-text">投稿者: {{ $post->user->name }}</p>
                                @can('delete-post', $post)
                                <div class="d-flex justify-content-between mb-4">
                                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">編集</a>
                                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="deletePost({{ $post->id }})">削除</button>
                                    </form>
                                </div>
                                @else
                                <p class='text-danger'>投稿を削除、編集するには投稿したアカウントで<a href="{{ route('login') }}" class='text-primary'>ログイン</a>してください。</p>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class='d-flex justify-content-center'>
                {{ $posts->links() }}
            </div>
            @auth
            <div class="text-center my-4">
                <a href="{{ route('posts.create') }}" class="btn btn-success">投稿を作成</a>
            </div>
            @else
            <p class="text-center">投稿を作成するには<a href="{{ route('login') }}" class="text-primary">ログイン</a>してください。</p>
            @endauth
            <div class="text-center mt-4">
                @if (Auth::check())
                <p>ログインユーザー: {{ Auth::user()->name }}</p>
                @else
                <p>ログインしていません</p>
                @endif
            </div>
        </div>
        <script>
            function deletePost(id) {
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>

            <div class="text-center">
                <a href="/" class="btn btn-secondary">戻る</a>
            </div>
            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        
    </x-app-layout>
</html>
