<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AppartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appartments = Appartment::all();
        return $appartments;
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

        Storage::disk('local')->putFileAs('public/images/appartments/', $file, $fullName);

        $appartment = new Appartment();

        $appartment->image = env("CLIENT_URL", 'http://localhost').'/storage/images/appartments/' . $name . '.' . $extension;

        $appartment->appartment_number = $request['appartment_number'];
        $appartment->square = $request['square'];
        $appartment->description = $request['description'];
        $appartment->phone_number = $request['phone_number'];

        $appartment->floor_id = $request['floor_id'];

        $appartment->save();
        return $appartment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appartment = Appartment::find($id);
        return $appartment;
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
        $appartment = Appartment::find($id);

        if ($request['image']) {
            $appartment->image = env("CLIENT_URL", 'http://localhost').'/storage/images/appartments/'.$request['image'];
        }

        $appartment->appartment_number = $request['appartment_number'];
        $appartment->square = $request['square'];
        $appartment->description = $request['description'];
        $appartment->phone_number = $request['phone_number'];

        $appartment->floor_id = $request['floor_id'];

        $appartment->save();
        return $appartment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appartment = Appartment::find($id);

        if (false != $appartment) {

            $image_value = explode('/', $appartment->image);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/appartments/'.$image_name);

            $appartment->delete();
            return "This appartment was deleted";
        } else {
            return "This appartment was deleted erlier";
        }
    }
}
