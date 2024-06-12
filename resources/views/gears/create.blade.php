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
            <h1>ギアを投稿!</h1>
        </x-slot>
        <div class="container mt-5">
            <form action="{{ route('gears.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="form-group">
                    <label for="title"><h2>タイトル</h2></label>
                    <input type="text" name="gear[title]" class="form-control" id="title" placeholder="タイトル" value="{{ old('gear.title') }}">
                    <p class="text-danger">{{ $errors->first('gear.title') }}</p>
                </div>
                <div class="form-group">
                    <label for="body"><h2>本文</h2></label>
                    <textarea name="gear[body]" class="form-control" id="body" placeholder="ギアの説明を書いてね">{{ old('gear.body') }}</textarea>
                    <p class="text-danger">{{ $errors->first('gear.body') }}</p>
                </div>
                <div class="form-group">
                    <label for="image">画像を選択</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                </div>
                <button type="submit" class="btn btn-primary btn-block">投稿</button>
            </form>
            <div class="text-center">
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
