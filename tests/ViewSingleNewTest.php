<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Article;

class ViewSingleNewTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test if single new is displayed correctly from its link on the index page
     *
     * @return void
     */
    public function testGoToSingleNewPage()
    {
        $createdNew = factory(Article::class)->create(['slug' => 'the-latest']);

        $this->visit('/articles/'. $createdNew->slug)
            ->see($createdNew->title);
    }
}
