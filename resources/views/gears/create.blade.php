<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>まとめスパッタリー!</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <x-slot name="header">
            create
        </x-slot>
        <body>
            <h1>まとめスパッタリー!</h1>
            
            <form action="{{ route('gears.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="title">
                    <h2>タイトル</h2>
                    <input type="text" name="gear[title]" placeholder="タイトル" value={{ old('gear.title') }}>
                    <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
                </div>
                <div class="body">
                    <h2>本文</h2>
                    <textarea name="gear[body]" placeholder="ギアの説明を書いてね" value={{ old('gear.body') }}></textarea>
                    <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
                </div>
                <div class="image">
                    <input type="file" name="image">
                </div>
                <input type="submit" value="投稿"/>
            </form>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>