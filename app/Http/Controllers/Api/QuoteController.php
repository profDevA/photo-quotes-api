<?php

namespace App\Http\Controllers\Api;

use App\Models\Quote;
use App\Models\Source;
use App\Models\Book;
use App\Models\Tag;
use App\Models\TagQuote;
use Illuminate\Http\Request;

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
        
        return response()->json($quotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $quote->update($request->all());

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

    }
}
