@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        {{ $articles->links() }}
        @foreach($articles as $article)
        <div class="card mb-5">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div>
                    <small class="text-success">
                        {{ $article->user->name }}
                    </small>
                    <small class="text-muted">
                        Comments: <b>{{ count($article->comments) }}</b>
                        Category: <b>{{ $article->category->name }}</b><br>
                        {{ $article->created_at }}
                    </small>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a href="{{ url("articles/detail/$article->id") }}" class="card-link">
                    View Detail &raquo;
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection