<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleType;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

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
        $sources = Source::all();
        $articlesTypes = ArticleType::all();
        return view('articles.create', compact('categories', 'sources', 'articlesTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'article_title' => 'required',
            'article_content' => 'required',
            'article_featured_image' => 'required',
        ]);

        $file_full_name = $request->file('article_featured_image')->getClientOriginalName();
        $file_name = pathinfo($file_full_name, PATHINFO_FILENAME);
        $file_ext = $request->file('article_featured_image')->getClientOriginalExtension();


        $new_file_name = $file_name;
        if (file_exists(public_path('uploads\\') . $file_full_name)) {
            $i = 1;
            while (file_exists(public_path('uploads\\') . $new_file_name . "." . $file_ext)) {
                $new_file_name = $file_name . "($i)";
                $i++;
            }
        }

        $request->file('article_featured_image')->move(public_path('uploads\\'), $new_file_name . '.' . $file_ext);

        // Summernote dom treatment
        $dom = new \DOMDocument();
        $dom->loadHtml($request->input('article_content'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {

            $data = $img->getAttribute('src');
            $image_full_name = $img->getAttribute('data-filename');
            $snot_image_name = explode('.', $image_full_name)[0];
            $snot_image_ext = explode('.', $image_full_name)[1];

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);

            $new_snot_image_name = $snot_image_name;

            if (file_exists(public_path('uploads\\') . $image_full_name)) {
                $i = 1;
                while (file_exists(public_path('uploads\\') . $new_snot_image_name . "." . $snot_image_ext)) {
                    $new_snot_image_name = $snot_image_name . "($i)";
                    $i++;
                }
            }

            $image_name = "/uploads/" . $new_snot_image_name . '.' . $snot_image_ext;
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->removeAttribute('data-filename');
            $img->setAttribute('src', $image_name);
        }

        $article = new Article;
        $article->title = $request->input('article_title');
        $article->text = $dom->saveHTML();
        $article->author = $request->input('author');
        $article->visible = $request->input('visible');
        $article->category_id = $request->input('category_id');
        $article->source_id = $request->input('source_id');
        $article->featured_image = $new_file_name . '.' . $file_ext;
        $article->url = $request->input('url');
        $article->meta_title = $request->input('meta_title') != '' ? $request->input('meta_title') : $request->input('article_title');
        $article->meta_description = $request->input('meta_description');
        $article->article_type = $request->input('article_type');
        $article->slug = Str::slug($request->input('article_title'), '-');

        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
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
        $sources = Source::all();
        $articlesTypes = ArticleType::all();
        return view('articles.edit', compact('article', 'categories', 'sources', 'articlesTypes'));
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
            $file_name = 'article' . time() . '.' . $request->file('article_featured_image')->extension();
            $request->file('article_featured_image')->move(public_path('uploads'), $file_name);
            $article->featured_image = $file_name;
        }

        // Summernote dom treatment
        $dom = new \DOMDocument();
        $dom->loadHtml($request->input('article_content'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {

            $data = $img->getAttribute('src');

            if (preg_match('/data:image/', $data)) {
                $image_full_name = $img->getAttribute('data-filename');
                $snot_image_name = explode('.', $image_full_name)[0];
                $snot_image_ext = explode('.', $image_full_name)[1];
    
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
    
                $data = base64_decode($data);
    
                $new_snot_image_name = $snot_image_name;
    
                if (file_exists(public_path('uploads\\') . $image_full_name)) {
                    $i = 1;
                    while (file_exists(public_path('uploads\\') . $new_snot_image_name . "." . $snot_image_ext)) {
                        $new_snot_image_name = $snot_image_name . "($i)";
                        $i++;
                    }
                }
    
                $image_name = "/uploads/" . $new_snot_image_name . '.' . $snot_image_ext;
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->removeAttribute('data-filename');
                $img->setAttribute('src', $image_name);
            }
        }

        $article->title = $request->input('article_title');
        $article->text = $dom->saveHTML();
        $article->author = $request->input('author');
        $article->visible = $request->input('visible');
        $article->category_id = $request->input('category_id');
        $article->source_id = $request->input('source_id');
        $article->url = $request->input('url');
        $article->meta_title = $request->input('meta_title') != '' ? $request->input('meta_title') : $request->input('article_title');
        $article->meta_description = $request->input('meta_description');
        $article->slug = Str::slug($request->input('article_title'), '-');
        $article->article_type = $request->input('article_type');

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
