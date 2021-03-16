<?php

namespace App\Http\Controllers;

use App\Models\RCHouseHover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RCHouseHoversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $r_c_house_hovers = RCHouseHover::all();
        return $r_c_house_hovers;
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

        Storage::disk('local')->putFileAs('public/images/r_c_house_hovers/', $file, $fullName);


        $r_c_house_hover = new RCHouseHover();

        $r_c_house_hover->svg = env("CLIENT_URL", 'http://localhost').'/storage/images/r_c_house_hovers/' . $name . '.' . $extension;

        $r_c_house_hover->r_c_house_id = $request['r_c_house_id'];
        $r_c_house_hover->r_c_house_description_id = $request['r_c_house_description_id'];
        $r_c_house_hover->house_link_id = $request['house_link_id'];

        $r_c_house_hover->save();
        return $r_c_house_hover;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $r_c_house_hover = RCHouseHover::find($id);
        return $r_c_house_hover;
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
        $r_c_house_hover = RCHouseHover::find($id);

        if ($request['svg']) {
            $r_c_house_hover->svg = env("CLIENT_URL", 'http://localhost').'/storage/images/r_c_house_hovers/'.$request['svg'];
        }
        $r_c_house_hover->r_c_house_id = $request['r_c_house_id'];
        $r_c_house_hover->r_c_house_description_id = $request['r_c_house_description_id'];
        $r_c_house_hover->house_link_id = $request['house_link_id'];

        $r_c_house_hover->save();
        return $r_c_house_hover;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r_c_house_hover = RCHouseHover::find($id);

        if (false != $r_c_house_hover) {

            $image_value = explode('/', $r_c_house_hover->svg);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/r_c_house_hovers/'.$image_name);

            $r_c_house_hover->delete();
            return "This r_c_house_hover was deleted";
        } else {
            return "This r_c_house_hover was deleted erlier";
        }
    }
}
