<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>まとめスパッタリー!</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        @vite(['resources/sass/app.scss','resources/js/app.js'])
        
    </head>
    
    <x-app-layout>
        <x-slot name="header" class="display-1">
            まとめスパッタリー!
        </x-slot>
        <body >
            <div class='flex justify-center items-center flex-col '>
                <div class='fs-1 text-primary gears'>
                    <a href="/gears/index">みんなのギアはこちら</a>
                </div>
                <form action="/posts/search" method="GET">
                    @csrf
                    <input type="text" name="keyword" placeholder="検索キーワードを入力">
                    <button type="submit" class="btn btn-primary">検索</button>
                </form>
            </div>
            <div class='flex posts'>
                @foreach ($posts as $post)
                    <div class='m-5 post'>
                        <h2 class='fs-2 text-primary title'>
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </h2>
                        <a href="/categories/{{ $post->category->id }}" class="border-3 border-secondary">{{ $post->category->name }}</a>
                        
                        <p class='fs-5 body'>{{ $post->body }}</p>
                        <p class="user">投稿者: {{ $post->user->name }}</p>
                        @can('delete-post', $post)
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-primary" onclick="deletePost({{ $post ->id }})">削除</button>
                        </form>
                        @else
                        <p class='text-red-500'>投稿を削除するには投稿したアカウントで<a href="{{ route('login') }}" class='fs-5 text-primary'>ログイン</a>してください。</p>
                        @endcan
                    </div>
                @endforeach
                </div>
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            </div>
            @auth
            <div class="fs-3 text-center text-primary">
                <a href="{{ route('posts.create') }}">投稿を作成</a>
            </div>
            @else
            <p>投稿を作成するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
            @endauth
            <script>
                function deletePost(id) {
                    'use strict'
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
            <div class="text-end user_name">
                @if (Auth::check())
                <p>ログインユーザー: {{ Auth::user()->name }}</p>
                @else
                <p>ログインしていません</p>
                @endif
            </div>
        </body>
    </x-app-layout>
</html>