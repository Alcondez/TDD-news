@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Latest News</h1>
            </div>
        </div>
        @for ($i = 0; $i < count($articles); $i++)
            @if(($i % 2) == 0)
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ $articles[$i]->title }}</div>

                            <div class="panel-body">
                                {{ $articles[$i]->excerpt }}
                            </div>

                            <div class="panel-footer">
                                <a href="{{ action('ArticlesController@show', ['slug' => $articles[$i]->slug]) }}">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{ $articles[$i]->title }}</div>

                                <div class="panel-body">
                                    {{ $articles[$i]->excerpt }}
                                </div>

                                <div class="panel-footer">
                                    <a href="{{ action('ArticlesController@show', ['slug' => $articles[$i]->slug]) }}">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
            @endif
        @endfor
    </div>
@endsection