<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\ResidentialComplex;
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
        $complex = [];
        foreach ($slides as $slide) {
            $residential_complex = $slide->residential_complex()->get();

            foreach ($residential_complex as $residential_complex_value) {
                $residential_complex_id = ResidentialComplex::find($residential_complex_value->residential_complex_id);

            }
            array_push($complex, compact('slide', 'residential_complex'));
        }
        return $complex;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slide = new Slide();

        $slide->residential_complex_id = $request['residential_complex_id'];

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
        //
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

        $slide->residential_complex_id = $request['residential_complex_id'];

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
            $slide->delete();
            return "This Slide was deleted";
        } else {
            return "This Slide was deleted erlier";
        }
    }
}
