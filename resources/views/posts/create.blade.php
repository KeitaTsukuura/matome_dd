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
            <h1>投稿を作成!</h1>
        </x-slot>
        <body>
            <div class="container mt-5">
                <form action="/posts" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title"><h2>タイトル</h2></label>
                        <input type="text" name="post[title]" class="form-control" id="title" placeholder="タイトル" value="{{ old('post.title') }}">
                        <p class="text-danger">{{ $errors->first('post.title') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="body"><h2>本文</h2></label>
                        <textarea name="post[body]" class="form-control" id="body" placeholder="スパッタリーのことを書いてね">{{ old('post.body') }}</textarea>
                        <p class="text-danger">{{ $errors->first('post.body') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="category"><h2>カテゴリー</h2></label>
                        <select name="post[category_id]" class="form-control" id="category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">投稿</button>
                </form>
                <div class="text-center mt-4">
                    <a href="/" class="btn btn-secondary">戻る</a>
                </div>
            </div>
            <!-- Bootstrap JS and dependencies -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
    </x-app-layout>
</html>
