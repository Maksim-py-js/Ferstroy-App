<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::all();
        $data = [];
        foreach ($years as $year) {
            $residential_complexes = $year->residential_complexes('year_id')->get();
            $year_value = $year;
            array_push($data, compact(
                'year_value',
                'residential_complexes'
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
        $year = new Year();
        $year->name = $request['name'];
        $year->save();
        return $year;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $year = Year::find($id);
        return $year;
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
        $year = Year::find($id);
        $year->name = $request['name'];
        $year->save();
        return $year;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year = Year::find($id);
        if (false != $year) {
            $year->delete();
            return "This $year->name was deleted";
        } else {
            return "This year was deleted erlier";
        }
    }
}
