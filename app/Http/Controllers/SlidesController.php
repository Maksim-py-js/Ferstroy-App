<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return $slides;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);

        $file = $request->file('image');
        $name = date('dmyhis');
        $extension = $file->getClientOriginalExtension();
        $fullName = ($name . '.' . $extension);

        Storage::disk('local')->putFileAs('public/images/slides/', $file, $fullName);
        $slide = new Slide();

        $slide->image = env("CLIENT_URL", 'http://localhost').'/storage/images/slides/' . $name . '.' . $extension;

        $slide->save();
        return $slide;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = Slide::find($id);
        return $slide;
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
        $slide = Slide::find($id);

        if ($request['image']) {
            $slide->image = env("CLIENT_URL", 'http://localhost').'/storage/images/slides/'.$request['image'];
        }
        $slide->save();
        return $slide;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id);

        if (false != $slide) {

            $image_value = explode('/', $slide->image);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/slides/'.$image_name);

            $slide->delete();
            return "This Slide was deleted";
        } else {
            return "This Slide was deleted erlier";
        }
    }
}
