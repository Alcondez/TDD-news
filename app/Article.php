<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public static function getLatest()
    {
        return Article::orderBy('date', 'desc')->take(10)->get();
    }

    public static function findBySlug($slug)
    {
        return Article::where('slug', $slug)->first()->get()->first();
    }
}
