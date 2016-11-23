@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>{{ $article->title }}</h2>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-12 text-center" >

            <img class="img-responsive" src="{{ asset($article->photo_path) }}" alt="">
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 text-center">

            {{ $article->body }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <a class="btn btn-block btn-primary" href="{{ action('ArticlesController@generatePdf', ['slug' => $article->slug]) }}">
                Download PDF
            </a>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection