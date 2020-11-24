<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Source;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->get();

        return view('photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sources = Source::orderBy('created_at', 'desc')->get();
        return view('photo.create', compact('sources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo_data = $request->all();

        unset($photo_data['photo']);
        unset($photo_data['submitType']);

        $photo_full_name = $request->file('photo')->getClientOriginalName();
        $photo_name = pathinfo($photo_full_name, PATHINFO_FILENAME);
        $photo_ext = $request->file('photo')->getClientOriginalExtension();

        $new_photo_name = $photo_name;

        if (file_exists(public_path('uploads\\') . $photo_full_name)) {
            $i = 1;
            while(file_exists(public_path('uploads\\') . $new_photo_name . '.' . $photo_ext)) {
                $new_photo_name = $photo_name . "($i)";
                $i++;
            }
        }

        $request->file('photo')->move(public_path('uploads\\'), $new_photo_name . '.' . $photo_ext);

        $photo_data['url'] = url('uploads') . '/' . $new_photo_name . '.' . $photo_ext;

        Photo::create($photo_data);

        if ($request->input('submitType') == 'continue') {
            return redirect()->route('photos.create');
        }

        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $sources = Source::orderBy('created_at', 'desc')->get();

        return view('photo.edit', compact('sources', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $photo_data = $request->all();

        if ($request->file('photo')) {
            unset($photo_data['photo']);
    
            $photo_full_name = $request->file('photo')->getClientOriginalName();
            $photo_name = pathinfo($photo_full_name, PATHINFO_FILENAME);
            $photo_ext = $request->file('photo')->getClientOriginalExtension();
    
            $new_photo_name = $photo_name;
    
            if (file_exists(public_path('uploads\\') . $photo_full_name)) {
                $i = 1;
                while(file_exists(public_path('uploads\\') . $new_photo_name . '.' . $photo_ext)) {
                    $new_photo_name = $photo_name . "($i)";
                    $i++;
                }
            }

            $request->file('photo')->move(public_path('uploads\\'), $new_photo_name . '.' . $photo_ext);
    
            $photo_data['url'] = url('uploads') . '/' . $new_photo_name . '.' . $photo_ext;
        }

        $photo->update($photo_data);

        return redirect()->route('photos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return back();
    }
}
