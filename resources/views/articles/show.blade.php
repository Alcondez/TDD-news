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

            <img src="{{ asset($article->photo_path) }}" alt="">
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 text-center">

            {{ $article->body }}
        </div>
    </div>
</div>
@endsection