<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>まとめスパッタリー!</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content_post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>
            </div>
        </div>
        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">編集</a>
        </div>
        
        <div class="comments">
            <h2>コメント一覧</h2>
            @foreach ($post->comments as $comment)
                <div class="comment">
                    <p>{{ $comment->body }}</p>
                    <p>投稿日時: {{ $comment->created_at }}</p>
                </div>
            @endforeach
        </div>
        
        <form action="/comments" method="POST">
            @csrf
            <div class="comment">
                <h2>コメントを追加</h2>
                <textarea name="comment[body]" placeholder="コメントを書いてね">{{ old('comment.body') }}</textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <p class="comment_error" style="color:red">{{ $errors->first('comment.body') }}</p>
            </div>
            <input type="submit" value="コメントする"/>
        </form>

        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>