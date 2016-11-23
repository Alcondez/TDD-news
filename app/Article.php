<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'excerpt', 'slug','photo_path','body','date','user_id'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getLatest()
    {
        return Article::orderBy('date', 'desc')->take(10)->get();
    }

    public static function findBySlug($slug)
    {
        return Article::where('slug', $slug)->first()->get()->first();
    }
}
