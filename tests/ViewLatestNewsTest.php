<?php
/**
 * Created by PhpStorm.
 * User: developer10
 * Date: 22/11/16
 * Time: 08:31 AM
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Article;


class ViewLatestNewsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Tests if an unauthenticated user can see the latest 10 news
     *
     * @return void
     */
    public function testViewingLastestNews()
    {
        $news = factory(Article::class, 14)->create();

        $latestNewsTitles = Article::getLatest()->lists('title')->toArray();

        foreach ($latestNewsTitles as $title) {
            $this->visit('/')->see($title);
        }
    }


}