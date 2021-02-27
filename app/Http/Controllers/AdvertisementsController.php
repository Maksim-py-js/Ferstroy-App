<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdvertisementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::all();
        return $advertisements;
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

        $advertisement = new Advertisement();

        Storage::disk('local')->putFileAs('public/images/advertisements/', $file, $fullName);

        $advertisement->image = env("CLIENT_URL", 'http://localhost').'/storage/images/advertisements/' . $name . '.' . $extension;

        $advertisement->sub_title = $request['sub_title'];
        $advertisement->title = $request['title'];
        $advertisement->name = $request['name'];
        $advertisement->sub_name = $request['sub_name'];
        $advertisement->button = $request['button'];

        $advertisement->save();
        return $advertisement;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advertisement = Advertisement::find($id);
        return $advertisement;
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
        $advertisement = Advertisement::find($id);

        if ($request['image']) {
            $advertisement->image = env("CLIENT_URL", 'http://localhost').'/storage/images/advertisements/'.$request['image'];
        }
        $advertisement->sub_title = $request['sub_title'];
        $advertisement->title = $request['title'];
        $advertisement->name = $request['name'];
        $advertisement->sub_name = $request['sub_name'];
        $advertisement->button = $request['button'];
        $advertisement->save();
        return $advertisement;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advertisement = Advertisement::find($id);
        if (false != $advertisement) {

            $image_value = explode('/', $advertisement->image);
            ob_start();
            echo end ($image_value);
            $image_name = ob_get_clean();

            File::delete('storage/images/advertisements/'.$image_name);

            $advertisement->delete();
            return "This Advertisement was deleted";
        } else {
            return "This Advertisement was deleted erlier";
        }
    }
}
