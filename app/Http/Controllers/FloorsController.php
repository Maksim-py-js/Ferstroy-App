<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floors = Floor::all();
        $data = [];

        foreach ($floors as $floor_value) {
            $floor_hovers = $floor_value->floor_hovers('floor_id')->get();
            $appartments = $floor_value->appartments('floor_id')->get();

            $floor = $floor_value;
            array_push($data, compact(
                'floor',
                'floor_hovers',
                'appartments'
            ));
        }

        return json_encode($data);
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

        Storage::disk('local')->putFileAs('public/images/floors/', $file, $fullName);

        $floor = new Floor();

        $floor->image = env("CLIENT_URL", 'http://localhost').'/storage/images/floors/' . $name . '.' . $extension;

        $floor->floor_number = $request['floor_number'];
        $floor->square = $request['square'];
        $floor->description = $request['description'];

        $floor->house_id = $request['house_id'];

        $floor->save();
        return $floor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $floor_value = Floor::find($id);
        $data = [];

        $floor_hovers = $floor_value->floor_hovers('floor_id')->get();
        $appartments = $floor_value->appartments('floor_id')->get();

        $floor = $floor_value;
        array_push($data, compact(
            'floor',
            'floor_hovers',
            'appartments'
        ));


        return json_encode($data);
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
        $floor = Floor::find($id);

        if ($request['image']) {
            $floor->image = env("CLIENT_URL", 'http://localhost').'/storage/images/floors/'.$request['image'];
        }

        $floor->floor_number = $request['floor_number'];
        $floor->square = $request['square'];
        $floor->description = $request['description'];

        $floor->house_id = $request['house_id'];

        $floor->save();
        return $floor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $floor = Floor::find($id);

        if (false != $floor) {

            $image_value = explode('/', $floor->image);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/floors/'.$image_name);

            $floor->delete();
            return "This floor was deleted";
        } else {
            return "This floor was deleted erlier";
        }
    }
}
