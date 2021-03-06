<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Article;

class NewsTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * Test if the getLatest method return the latest 10 articles
     *
     * @return void
     */
    public function testGettingLatestNews()
    {
        factory(Article::class, 13)->create();

        $latestNews = Article::getLatest();

        $this->assertCount(10,$latestNews);
    }

    public function testANewCanBeFoundBySlug()
    {
        $createdNew = factory(Article::class)->create(['slug' => 'the-latest']);

        $foundNew = Article::findBySlug('the-latest');

        $this->assertEquals($createdNew->id, $foundNew->id);
        $this->assertEquals($createdNew->title, $foundNew->title);
    }
}
