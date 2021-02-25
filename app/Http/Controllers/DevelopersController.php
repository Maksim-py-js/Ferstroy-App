<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DevelopersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = Developer::all();
        return $developers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $developer = new Developer();

        $developer->name = $request['name'];
        $developer->number = $request['number'];
        $developer->rating = $request['rating'];

        $developer->company_name = $request['company_name'];
        $developer->company_number = $request['company_number'];
        $developer->company_history = $request['company_history'];
        $developer->company_foundation_date = $request['company_foundation_date'];
        $developer->company_address = $request['company_address'];

        $developer->count_workers = $request['count_workers'];
        $developer->count_machinery = $request['count_machinery'];

        $developer->count_objects = $request['count_objects'];
        $developer->count_constructed_objects = $request['count_constructed_objects'];
        $developer->count_under_constructed_objects = $request['count_under_constructed_objects'];

        $developer->save();
        return $developer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developer::find($id);
        return $developer;
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
        $developer = Developer::find($id);

        $developer->name = $request['name'];
        $developer->number = $request['number'];
        $developer->rating = $request['rating'];

        $developer->company_name = $request['company_name'];
        $developer->company_number = $request['company_number'];
        $developer->company_history = $request['company_history'];
        $developer->company_foundation_date = $request['company_foundation_date'];
        $developer->company_address = $request['company_address'];

        $developer->count_workers = $request['count_workers'];
        $developer->count_machinery = $request['count_machinery'];

        $developer->count_objects = $request['count_objects'];
        $developer->count_constructed_objects = $request['count_constructed_objects'];
        $developer->count_under_constructed_objects = $request['count_under_constructed_objects'];

        $developer->save();
        return $developer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer = Developer::find($id);
        if (false != $developer) {
            $developer->delete();
            return "This Developer was deleted";
        } else {
            return "This Developer was deleted erlier";
        }
    }
}
