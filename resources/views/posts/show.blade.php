<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

<body>
    <x-app-layout>
        <x-slot name="header">
            <h1>{{ $post->title }}</h1>
        </x-slot>
    
        <div class="container mt-5">
            <div class="content_post text-center mb-4">
                <h3>本文</h3>
                <p class="border border-secondary p-3 fs-2">{{ $post->body }}</p>
                <div class="d-flex justify-content-end gap-3">
                <p class='user'>投稿者: {{ $post->user->name }}</p>
                <p>投稿日時: {{ $post->created_at }}</p>
                <a href="/categories/{{ $post->category->id }}" class="badge badge-secondary">{{ $post->category->name }}</a>
                </div>
            </div>
            @can('delete-post', $post)
            <div class="text-center mb-4">
                <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">編集</a>
            </div>
            @endcan
            <div class="comments text-center mb-5">
                <h2>コメント一覧</h2>
                @foreach ($post->comments as $comment)
                    <div class="comment border p-3 mb-3">
                        <p class="fs-3">{{ $comment->body }}</p>
                        <div class="d-flex justify-content-end gap-3">
                        <p class='user'>投稿者: {{ $comment->user->name }}</p>
                        <p>投稿日時: {{ $comment->created_at }}</p>
                        </div>
                        <div class="accordion" id="accordionReplies{{ $comment->id }}">
                            <div class="card">
                                <div class="card-header" id="heading{{ $comment->id }}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $comment->id }}" aria-expanded="true" aria-controls="collapse{{ $comment->id }}">
                                            返信を開く
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse{{ $comment->id }}" class="collapse" aria-labelledby="heading{{ $comment->id }}" data-parent="#accordionReplies{{ $comment->id }}">
                                    <div class="card-body">
                                        @foreach ($comment->replies as $reply)
                                            <div class="reply border p-3 mb-3">
                                                <p class="fs-3">{{ $reply->body }}</p>
                                                <div class="d-flex justify-content-end gap-3">
                                                <p class='user'>投稿者: {{ $reply->user->name }}</p>
                                                <p>投稿日時: {{ $reply->created_at }}</p>
                                                </div>

                                                @can('delete', $reply)
                                                <form action="/replies/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" onclick="deleteReply({{ $reply->id }})">返信削除</button>
                                                </form>
                                                @endcan
                                            </div>
                                        @endforeach
                                        @auth
                                        <form action="/replies" method="POST" class="mt-3">
                                            @csrf
                                            <div class="form-group">
                                                <h3>返信を追加</h3>
                                                <textarea name="reply[body]" class="form-control" placeholder="返信を書いてね">{{ old('reply.body') }}</textarea>
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                @if ($errors->has('reply.body'))
                                                    <p class="text-danger">{{ $errors->first('reply.body') }}</p>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-primary">返信する</button>
                                        </form>
                                        @else
                                        <p>返信を追加するには<a href="{{ route('login') }}" class="text-primary">ログイン</a>してください。</p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        
            
            
                        @can('delete', $comment)
                        <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="deleteComment({{ $comment->id }})">コメント削除</button>
                        </form>
                        
                        @endcan
                    </div>
                @endforeach
            </div>
            <script>
                function deleteComment(id) {
                    'use strict';
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
                function deleteReply(id) {
                    'use strict';
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
            
            @auth
            <form action="/comments" method="POST" class="mb-5">
                @csrf
                <div class="form-group">
                    <h2>コメントを追加</h2>
                    <textarea name="comment[body]" class="form-control" placeholder="コメントを書いてね">{{ old('comment.body') }}</textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    @if ($errors->has('comment.body'))
                        <p class="text-danger">{{ $errors->first('comment.body') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">コメントする</button>
            </form>
            @else
            <p>コメントを追加するには<a href="{{ route('login') }}" class="text-primary">ログイン</a>してください。</p>
            @endauth

            <div class="text-center">
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
