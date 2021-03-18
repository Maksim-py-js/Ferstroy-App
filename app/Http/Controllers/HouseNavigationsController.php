<?php

namespace App\Http\Controllers;

use App\Models\HouseNavigation;
use Illuminate\Http\Request;

class HouseNavigationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $house_navigations = HouseNavigation::all();
        return $house_navigations;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $house_navigation = new HouseNavigation();

        $house_navigation->number = $request['number'];
        $house_navigation->house_id = $request['house_id'];
        $house_navigation->floor_id = $request['floor_id'];
        $house_navigation->house_hover_id = $request['house_hover_id'];

        $house_navigation->save();
        return $house_navigation;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house_navigation = HouseNavigation::find($id);
        return $house_navigation;
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
        $house_navigation = HouseNavigation::find($id);

        $house_navigation->number = $request['number'];
        $house_navigation->house_id = $request['house_id'];
        $house_navigation->floor_id = $request['floor_id'];
        $house_navigation->house_hover_id = $request['house_hover_id'];

        $house_navigation->save();
        return $house_navigation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house_navigation = HouseNavigation::find($id);
        if (false != $house_navigation) {
            $house_navigation->delete();
            return "This house_navigation was deleted";
        } else {
            return "This house_navigation was deleted erlier";
        }
    }
}
