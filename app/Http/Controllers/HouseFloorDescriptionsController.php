<?php

namespace App\Http\Controllers;

use App\Models\HouseFloorDescription;
use Illuminate\Http\Request;

class HouseFloorDescriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $house_floor_descriptions = HouseFloorDescription::all();
        return $house_floor_descriptions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $house_floor_description = new HouseFloorDescription();

        $house_floor_description->number = $request['number'];
        $house_floor_description->count_appartments = $request['count_appartments'];
        $house_floor_description->house_id = $request['house_id'];

        $house_floor_description->positionTop = $request['positionTop'];
        $house_floor_description->positionRight = $request['positionRight'];
        $house_floor_description->positionBottom = $request['positionBottom'];
        $house_floor_description->positionLeft = $request['positionLeft'];


        $house_floor_description->save();
        return $house_floor_description;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house_floor_description = HouseFloorDescription::find($id);
        return $house_floor_description;
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
        $house_floor_description = HouseFloorDescription::find($id);

        $house_floor_description->number = $request['number'];
        $house_floor_description->count_appartments = $request['count_appartments'];
        $house_floor_description->house_id = $request['house_id'];

        $house_floor_description->positionTop = $request['positionTop'];
        $house_floor_description->positionRight = $request['positionRight'];
        $house_floor_description->positionBottom = $request['positionBottom'];
        $house_floor_description->positionLeft = $request['positionLeft'];


        $house_floor_description->save();
        return $house_floor_description;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house_floor_description = HouseFloorDescription::find($id);
        if (false != $house_floor_description) {
            $house_floor_description->delete();
            return "This house_floor_description was deleted";
        } else {
            return "This house_floor_description was deleted erlier";
        }
    }
}
