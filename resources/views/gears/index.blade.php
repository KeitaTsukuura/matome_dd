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
    @vite(['resources/sass/app.scss','resources/js/app.js'])
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h1>みんなのギア</h1>
        </x-slot>
        <div class='text-center my-4'>
            <form action="/gears/search" method="GET" class="form-inline justify-content-center">
                @csrf
                <input type="text" name="keyword" placeholder="検索キーワードを入力" class="form-control mr-2">
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
        <div class="container mt-5">
            <div class="row gears">
                @foreach ($gears as $gear)
                    <div class="col-md-4 mb-4 gear">
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="fs-2 text-primary title">
                                    <a href="/gears/{{ $gear->id }}">{{ $gear->title }}</a>
                                </h2>
                                <p class="body">{{ $gear->body }}</p>
                                <div class="text-center">
                                    <img src="{{ $gear->image_url }}" class="img-fluid" alt="画像が読み込めません" />
                                </div>
                                <p class="user mt-2">投稿者: {{ $gear->user->name }}</p>
                                @can('update', $gear)
                                <div class="d-flex justify-content-between mt-2">
                                    <a href="/gears/{{ $gear->id }}/edit" class="btn btn-primary">編集</a>
                                <form action="/gears/{{ $gear->id }}" id="form_{{ $gear->id }}" method="post" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="deleteGear({{ $gear->id }})">削除</button>
                                </form>
                                </div>
                                
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $gears->links() }}
            </div>
            @auth
            <div class="text-center mt-4">
                <a href='/gears/create' class="btn btn-success">ギアを投稿</a>
            </div>
            @else
            <p class="text-center mt-4">ギアを投稿するには<a href="{{ route('login') }}" class="text-primary">ログイン</a>してください。</p>
            @endauth
            
            <script>
                function deleteGear(id) {
                    'use strict';
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
            
            <div class="text-center mt-4">
                @if (Auth::check())
                <p>ログインユーザー: {{ Auth::user()->name }}</p>
                @else
                <p>ログインしていません</p>
                @endif
            </div>
            <div class="text-center mt-4">
                <a href="/" class="btn btn-secondary">戻る</a>
            </div>
        </div>
    </x-app-layout>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
