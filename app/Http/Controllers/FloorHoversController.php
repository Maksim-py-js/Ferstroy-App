<?php

namespace App\Http\Controllers;

use App\Models\FloorHover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FloorHoversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floor_hovers = FloorHover::all();
        return $floor_hovers;
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

        Storage::disk('local')->putFileAs('public/images/floor_hovers/', $file, $fullName);

        $floor_hover = new FloorHover();

        $floor_hover->image = env("CLIENT_URL", 'http://localhost').'/storage/images/floor_hovers/' . $name . '.' . $extension;

        $floor_hover->state = $request['state'];
        $floor_hover->floor_id = $request['floor_id'];
        $floor_hover->appartment_id = $request['appartment_id'];

        $floor_hover->save();
        return $floor_hover;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $floor_hover = FloorHover::find($id);
        return $floor_hover;
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
        $floor_hover = FloorHover::find($id);

        if ($request['image']) {
            $floor_hover->image = env("CLIENT_URL", 'http://localhost').'/storage/images/floor_hovers/'.$request['image'];
        }

        $floor_hover->state = $request['state'];
        $floor_hover->floor_id = $request['floor_id'];
        $floor_hover->appartment_id = $request['appartment_id'];

        $floor_hover->save();
        return $floor_hover;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $floor_hover = FloorHover::find($id);

        if (false != $floor_hover) {

            $image_value = explode('/', $floor_hover->image);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/floor_hovers/'.$image_name);

            $floor_hover->delete();
            return "This floor_hover was deleted";
        } else {
            return "This floor_hover was deleted erlier";
        }
    }
}
