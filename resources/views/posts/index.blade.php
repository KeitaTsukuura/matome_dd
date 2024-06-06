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
        <x-slot name="header" class='text-blue-600'>
            まとめスパッタリー!
        </x-slot>
        <body>
           
            <div class='flex justify-center items-center flex-col '>
                <div class='gears'>
                    <a href="/gears/index">みんなのギアはこちら</a>
                </div>
                <form action="/posts/search" method="GET">
                    @csrf
                    <input type="text" name="keyword" placeholder="検索キーワードを入力">
                    <input type="submit" value="検索">
                </form>
            </div>
            <div class='flex posts'>
                @foreach ($posts as $post)
                    <div class='m-5 post'>
                        <h2 class='title'>
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </h2>
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        <p class='body'>{{ $post->body }}</p>
                        <p class='user'>投稿者: {{ $post->user->name }}</p>
                        @can('delete-post', $post)
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-primary" onclick="deletePost({{ $post ->id }})">削除</button>
                        </form>
                        @else
                        <p class='text-red-500'>投稿を削除するには投稿したアカウントで<a href="{{ route('login') }}">ログイン</a>してください。</p>
                        @endcan
                    </div>
                @endforeach
                </div>
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            </div>
            @auth
            <a href="{{ route('posts.create') }}">投稿を作成</a>
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