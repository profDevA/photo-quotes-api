<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category')->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'article_title' => 'required',
            'article_content' => 'required',
            'article_featured_image' => 'required',
        ]);

        $file_name = 'article' . time().'.'.$request->file('article_featured_image')->extension();  
        $request->file('article_featured_image')->move(public_path('uploads'), $file_name);

        $article = new Article;
        $article->title = $request->input('article_title');
        $article->text = $request->input('article_content');
        $article->author = $request->input('author');
        $article->visible = $request->input('visible');
        $article->category_id = $request->input('category_id');
        $article->url = $file_name;

        if (Auth::user()->is_admin == 1) {
            $article->article_type = 1;
        } else {
            $article->article_type = 2;
        }

        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        $categories = Category::all();

        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
        $request->validate([
            'article_title' => 'required',
            'article_content' => 'required',
        ]);

        if ($request->file('article_featured_image')) {
            $file_name = 'article' . time().'.'.$request->file('article_featured_image')->extension();  
            $request->file('article_featured_image')->move(public_path('uploads'), $file_name);
            $article->url = $file_name;
        }

        $article->title = $request->input('article_title');
        $article->text = $request->input('article_content');
        $article->author = $request->input('author');
        $article->visible = $request->input('visible');
        $article->category_id = $request->input('category_id');

        if (Auth::user()->is_admin == 1) {
            $article->article_type = 1;
        } else {
            $article->article_type = 2;
        }

        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();

        return back();
    }
}
