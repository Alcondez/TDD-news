@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <ul class="list-group">
                @foreach($articles as $article)
                    <li class="list-group-item clearfix">
                        <a href="{{ action('ArticlesController@show', ['slug' => $article->slug]) }}">{{ $article->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection