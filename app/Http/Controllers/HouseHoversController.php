<?php

namespace App\Http\Controllers;

use App\Models\HouseHover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HouseHoversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $house_hovers = HouseHover::all();
        return $house_hovers;
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
            'svg' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);

        $file = $request->file('svg');
        $name = date('dmyhis');
        $extension = $file->getClientOriginalExtension();
        $fullName = ($name . '.' . $extension);

        Storage::disk('local')->putFileAs('public/images/house_hovers/', $file, $fullName);

        $house_hover = new HouseHover();

        $house_hover->svg = env("CLIENT_URL", 'http://localhost').'/storage/images/house_hovers/' . $name . '.' . $extension;

        $house_hover->house_id = $request['house_id'];
        $house_hover->floor_id = $request['floor_id'];

        $house_hover->save();
        return $house_hover;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house_hover = HouseHover::find($id);
        return $house_hover;
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
        $house_hover = HouseHover::find($id);

        if ($request['svg']) {
            $house_hover->svg = env("CLIENT_URL", 'http://localhost').'/storage/images/house_hovers/'.$request['svg'];
        }

        $house_hover->house_id = $request['house_id'];
        $house_hover->floor_id = $request['floor_id'];

        $house_hover->save();
        return $house_hover;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house_hover = HouseHover::find($id);

        if (false != $house_hover) {

            $image_value = explode('/', $house_hover->svg);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/house_hovers/'.$image_name);

            $house_hover->delete();
            return "This house_hover was deleted";
        } else {
            return "This house_hover was deleted erlier";
        }
    }
}
