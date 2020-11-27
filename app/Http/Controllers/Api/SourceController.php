<?php

namespace App\Http\Controllers\Api;

use App\Models\Source;
use App\Models\Quote;
use App\Models\Book;
use App\Models\Article;
use App\Models\Photo;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::all();
        return response()->json($sources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Source::create($request->all());
        // return redirect('sources');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $source = Source::where('slug', $slug)->first();
        $quotes = Quote::where('sourceId', $source['id'])->with('tagquote')->with('book')->get();

        foreach($quotes as $quote){
            $tag_names = array();
            $tagquotes = $quote->tagquote;
            foreach ($tagquotes as $tagquote) {
                $tag_names[] = $tagquote->tag->name;
                
            }
            $quote['tag_name'] = $tag_names;
        }

        $books = Book::where('source_id', $source['id'])->get();
        $gallery = Photo::where('sourceId', $source['id'])->get();
        $articles = Article::where('source_id', $source['id'])->where('article_type', 'Article')->get();
        $interviews = Article::where('source_id', $source['id'])->where('article_type', 'Interview')->get();
        $source['Quotes'] = $quotes;
        $source['Books'] = $books;
        $source['Articles'] = $articles;
        $source['Gallery'] = $gallery;
        $source['Interviews'] = $interviews;

        return response()->json($source);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        // return view('source.edit', compact('source'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Source $source)
    {
        //
        // $source->update($request->all());
        // return redirect('sources');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
 
    }
}
