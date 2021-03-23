<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();
        $data = [];

        foreach ($houses as $house_value) {
            $house_hovers = $house_value->house_hovers('house_id')->get();
            $house_floor_descriptions = $house_value->house_floor_descriptions('house_id')->get();
            $house_navigations = $house_value->house_navigations('house_id')->get();
            $floors_data = $house_value->floors('house_id')->get();

            $floors = [];
            foreach ($floors_data as $floor_value) {
                $floor_hovers = $floor_value->floor_hovers('floor_id')->get();
                $appartments = $floor_value->appartments('floor_id')->get();
                $floor = $floor_value;
                array_push($floors, compact('floor', 'floor_hovers', 'appartments'));
            }

            $house = $house_value;
            array_push($data, compact(
                'house',
                'house_hovers',
                'house_floor_descriptions',
                'house_navigations',
                'floors'
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
            'svg' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);

        $file = $request->file('svg');
        $name = date('dmyhis');
        $extension = $file->getClientOriginalExtension();
        $fullName = ($name . '.' . $extension);

        Storage::disk('local')->putFileAs('public/images/houses/', $file, $fullName);


        $house = new House();

        $house->svg = env("CLIENT_URL", 'http://localhost').'/storage/images/houses/' . $name . '.' . $extension;
        $house->residential_complex_id = $request['residential_complex_id'];

        $house->save();
        return $house;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house_value = House::find($id);
        $data = [];

        $house_hovers = $house_value->house_hovers('house_id')->get();
        $house_floor_descriptions = $house_value->house_floor_descriptions('house_id')->get();
        $house_navigations = $house_value->house_navigations('house_id')->get();
        $floors_data = $house_value->floors('house_id')->get();

        $floors = [];
        foreach ($floors_data as $floor_value) {
            $floor_hovers = $floor_value->floor_hovers('floor_id')->get();
            $appartments = $floor_value->appartments('floor_id')->get();
            $floor = $floor_value;
            array_push($floors, compact('floor', 'floor_hovers', 'appartments'));
        }

        $house = $house_value;
        array_push($data, compact(
            'house',
            'house_hovers',
            'house_floor_descriptions',
            'house_navigations',
            'floors'
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
        $house = House::find($id);

        if ($request['svg']) {
            $house->svg = env("CLIENT_URL", 'http://localhost').'/storage/images/houses/'.$request['svg'];
        }
        $house->residential_complex_id = $request['residential_complex_id'];
        $house->save();
        return $house;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::find($id);

        if (false != $house) {

            $image_value = explode('/', $house->svg);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/houses/'.$image_name);

            $house->delete();
            return "This house was deleted";
        } else {
            return "This house was deleted erlier";
        }
    }
}
