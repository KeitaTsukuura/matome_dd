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
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h1>ギアのタイトルと説明を編集!</h1>
        </x-slot>

        <div class="container mt-5">
            <form action="/gears/{{ $gear->id }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title"><h2>タイトル</h2></label>
                    <input type="text" name="gear[title]" class="form-control" id="title" placeholder="タイトル" value="{{ $gear->title }}">
                    <p class="text-danger">{{ $errors->first('gear.title') }}</p>
                </div>
                <div class="form-group">
                    <label for="body"><h2>本文</h2></label>
                    <textarea name="gear[body]" class="form-control" id="body" placeholder="ギアの説明を書いてね">{{ $gear->body }}</textarea>
                    <p class="text-danger">{{ $errors->first('gear.body') }}</p>
                </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                    <a href="/gears/index" class="btn btn-secondary">戻る</a>
            </form>
        </div>
    </x-app-layout>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
