<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Source;
use App\Models\Book;
use App\Models\Tag;
use App\Models\TagQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $quotes = Quote::all();


        foreach ($quotes as $key => $quote) {
            $quote->tags = '';
            if ($quote->tagquote) {
                foreach ($quote->tagquote as $tagquote) {
                    if ($tagquote->tag) {
                        $quote->tags .= $tagquote->tag->name . ', ';
                    }
                }
            }

            $quote->tags = substr(trim($quote->tags), 0, -1);
        }

        return view('quote.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sources = Source::all();
        $books = Book::all();
        return view('quote.create', compact('sources', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quote_data = $request->all();
        unset($quote_data['tags']);

        $tags_arr = array_map('trim', explode(',', $request->post('tags')));

        $quote = Quote::create($quote_data);

        foreach ($tags_arr as $key => $tag_name) {
            $tag = Tag::where('name', '=', $tag_name)->first();

            if ($tag === null) {
                $tag = new Tag;
                $tag->name = $tag_name;
                $tag->save();
            }

            $tag_quote = new TagQuote;

            $tag_quote->tagId = $tag->id;
            $tag_quote->quoteId = $quote->id;
            $tag_quote->save();
        }

        return redirect('quotes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        $books = Book::all();
        $sources = Source::all();
        $tags = array();

        foreach ($quote->tagquote as $key => $tagquote) {
            $tags[] = Tag::find($tagquote->tagId)->name;
        }

        $tags_str = implode(', ', $tags);

        return view('quote.edit', compact('quote', 'books', 'sources', 'tags_str'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        $quote_data = $request->all();
        unset($quote_data['tags']);

        $tags_arr = array_map('trim', explode(',', $request->post('tags')));

        $quote->update($quote_data);

        $oldtags_names = array();
        $oldtags = $quote->tagquote;
        foreach ($oldtags as $oldtag) {
            $oldtags_names[] = $oldtag->tag->name;
        }
        $filtered = array_diff($oldtags_names, $tags_arr);

        foreach ($filtered as $value){
            $tag = Tag::where('name', '=', $value)->first();
            TagQuote::where('tagId', $tag->id)->where('quoteId', $quote->id)->delete();
        }

        foreach ($tags_arr as $key => $tag_name) {
            $tag = Tag::where('name', '=', $tag_name)->first();

            if ($tag === null) {
                $tag = new Tag;
                $tag->name = $tag_name;
                $tag->save();
            }

            $tag_quote = TagQuote::where('tagId', $tag->id)->where('quoteId', $quote->id)->get();

            if (count($tag_quote) == 0) {
                $tag_quote = new TagQuote;
                $tag_quote->tagId = $tag->id;
                $tag_quote->quoteId = $quote->id;
                $tag_quote->save();
            }
        }

        return redirect('quotes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
        $quote->delete();

        return back();
    }
}
