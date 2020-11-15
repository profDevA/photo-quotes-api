<?php

namespace App\Http\Controllers;

use App\Models\ArticleType;
use Illuminate\Http\Request;

class ArticleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleTypes = ArticleType::all();
        return view('articles.types', compact('articleTypes'));
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
        ArticleType::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleType $articleType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleType $articleType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleType $articleType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleType $articleType)
    {
        $articleType->delete();
        return back();
    }
}
