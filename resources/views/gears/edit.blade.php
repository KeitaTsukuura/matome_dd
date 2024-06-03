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
            gears.edit
        </x-slot>
        <body>
            <h1>まとめスパッタリー!</h1>
            
            <form action="/gears/{{ $gear->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="title">
                    <h2>タイトル</h2>
                    <input type="text" name="gear[title]" placeholder="タイトル" value={{ $gear->title }}>
                    <p class="title_error" style="color:red">{{ $errors->first('gear.title') }}</p>
                </div>
                <div class="body">
                    <h2>本文</h2>
                    <textarea name="gear[body]" placeholder="ギアの説明を書いてね">{{ $gear->body }}</textarea>
                    <p class="body_error" style="color:red">{{ $errors->first('gear.body') }}</p>
                </div>
                <input type="submit" value="保存"/>
            </form>
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>