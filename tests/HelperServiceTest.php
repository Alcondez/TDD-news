<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;

class HelperServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSlugGeneration()
    {
        $helper = new \App\Services\HelperService();

        $slug = $helper->generateSlug('This is a Title');

        $this->assertEquals('this-is-a-title', $slug);
    }

    public function testImageProcessing()
    {
        $helper = new \App\Services\HelperService();

        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(base_path().'/public/images/testimage.jpg', 'testimage.jpg');

        $path = $helper->ProcessImage($uploadedFile);

        $this->assertTrue(strpos($path,'testimage.jpg')!==false);
    }
}
