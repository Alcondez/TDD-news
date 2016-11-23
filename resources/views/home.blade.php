@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <a class="btn btn-block btn-primary" href="{{ action('ArticlesController@create') }}">
            New Article
        </a>
    </div>
    <div class="row">
        <ul class="list-group">
            @foreach($articles as $article)
                <li class="list-group-item clearfix">
                    <a href="{{ action('ArticlesController@show', ['slug' => $article->slug]) }}">{{ $article->title }}</a>
                    <span class="pull-right">
						<form role="form" method="POST" action="/articles/{{ $article->id }}">
                        {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-primary btn-danger btn-sm">Delete</button>
						</form>
					</span>
                </li>
            @endforeach
        </ul>
    </div>

</div>
@endsection
