<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
        return view('source.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('source.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $source_data = $request->all();
        $full_name = $request->input('firstName') . ' ' . $request->input('middleName') . ' ' . $request->input('lastName'); 
        $source_data['slug'] = Str::slug($full_name, '-');

        $file_full_name = $request->file('backgroundImage')->getClientOriginalName();
        $file_name = pathinfo($file_full_name, PATHINFO_FILENAME);
        $file_ext = $request->file('backgroundImage')->getClientOriginalExtension();


        $new_file_name = $file_name;
        if (file_exists(public_path('uploads\\') . $file_full_name)) {
            $i = 1;
            while (file_exists(public_path('uploads\\') . $new_file_name . "." . $file_ext)) {
                $new_file_name = $file_name . "($i)";
                $i++;
            }
        }

        $request->file('backgroundImage')->move(public_path('uploads\\'), $new_file_name . '.' . $file_ext);

        $source_data['backgroundImage']= url('uploads') . '/' . $new_file_name . '.' . $file_ext;

        Source::create($source_data);

        return redirect('sources');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('source.edit', compact('source'));

        
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
        $source_data = $request->all();

        if ($request->file('backgroundImage')) {
            $file_full_name = $request->file('backgroundImage')->getClientOriginalName();
            $file_name = pathinfo($file_full_name, PATHINFO_FILENAME);
            $file_ext = $request->file('backgroundImage')->getClientOriginalExtension();
    
    
            $new_file_name = $file_name;
            if (file_exists(public_path('uploads\\') . $file_full_name)) {
                $i = 1;
                while (file_exists(public_path('uploads\\') . $new_file_name . "." . $file_ext)) {
                    $new_file_name = $file_name . "($i)";
                    $i++;
                }
            }
    
            $request->file('backgroundImage')->move(public_path('uploads\\'), $new_file_name . '.' . $file_ext);
    
            $source_data['backgroundImage']= url('uploads') . '/' . $new_file_name . '.' . $file_ext;
        }


        $source->update($source_data);

        return redirect('sources');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        $source->delete();
        return back();
    }
}
