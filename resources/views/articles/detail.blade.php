@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session("info"))
            <div class="alert alert-info">
                {{ session("info") }}
            </div>
        @endif
        <div class="card border-primary mb-5">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle small text-muted mb-2">
                    {{ $article->created_at }},
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                @auth
                    @can('update-article', $article)
                        <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-secondary mt-2">Edit
                        </a>
                    @endcan
                    @can('delete-article', $article)
                        <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-warning mt-2">Delete
                        </a>
                    @endcan
                @endauth
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    @auth
                        @can('delete-comment', $comment)
                            <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                        @endcan
                    @endauth
                    <b class="text-success">
                        {{ $comment->user->name }}
                    </b>
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>
        @auth
            <form action="{{ url("comments/add") }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                <input type="submit" value="Add Comment" class="btn btn-secondary">
            </form>
        @endauth
    </div>
@endsection