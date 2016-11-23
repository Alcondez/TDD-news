<?php

namespace App\Http\Controllers;

use App\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use Roumen\Feed\Feed;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class ArticlesController extends Controller
{

    protected $helperService;

    public function __construct(HelperService $helperServ)
    {
        $this->helperService = $helperServ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::getLatest();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:25',
            'excerpt' => 'required|max:50',
            'image' => 'required',
            'body' => 'required|',
        ]);

        $user = Auth::user();

        Article::create([

            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'slug' => $this->helperService->generateSlug($request->input('title')),
            'photo_path' => $this->helperService->ProcessImage($request->file('image')),
            'body' => $request->input('body'),
            'date' => new Carbon(),
            'user_id' => $user->id

        ]);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::findBySlug($slug);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        $article->delete();

        return redirect('/dashboard');
    }

    public function generateFeed()
    {
        $feed = new Feed();

        if (!$feed->isCached())
        {

            $articles = Article::orderBy('created_at', 'desc')->take(10)->get();

            // set your feed's title, description, link, pubdate and language
            $feed->title = 'Your title';
            $feed->description = 'Your description';
            $feed->link = url('feed');
            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
            $feed->pubdate = $articles[0]->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100); // maximum length of description text

            foreach ($articles as $article)
            {
                // set item's title, author, url, pubdate, description, content, enclosure (optional)*
                $feed->add(
                    $article->title,
                    $article->user()->get()->first()->name,
                    URL::to('/articles/'.$article->slug),
                    $article->created_at,
                    $article->excerpt,
                    $article->body);
            }

        }

        return $feed->render('atom');
    }

    public function generatePdf($slug)
    {
        $dompdf = new Dompdf();

        $article = Article::findBySlug($slug);

        $html = View::make('articles.pdfview', compact('article'))->render();

        $dompdf->loadHTML($html);
        //return $html;
        return $dompdf->stream();
    }
}
