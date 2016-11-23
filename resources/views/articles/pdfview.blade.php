<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>News Publishing App</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Lato';
        }
    </style>
</head>
<body id="app-layout">
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
    </div>
<!-- JavaScripts -->
</body>
</html>