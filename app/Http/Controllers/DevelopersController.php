<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use App\Models\Developer;
use App\Models\ResidentialComplex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $data = [];
        foreach ($developers as $developer) {
            $advantages = $developer->advantages('developer_id')->get();
            $developer_advantages = [];
            foreach ($advantages as $advantage_value) {
                $advantages_icons = $advantage_value->advantages_icons()->get();
                $advantage = $advantage_value;
                foreach ($advantages_icons as $advantage_icon) {
                    $icon_id = Advantage::find($advantage_icon->icon_id);
                }
                array_push($developer_advantages, compact('advantage', 'advantages_icons'));
            }
            $comments = $developer->comments('developer_id')->get();

            $years_data = $developer->years('developer_id')->get();
            $years = [];
            foreach ($years_data as $year_value) {
                $residential_complexes = $year_value->residential_complexes()->get();
                $year = $year_value;
                foreach ($residential_complexes as $residential_complex) {
                    $year_id = ResidentialComplex::find($residential_complex->year_id);
                }
                array_push($years, compact('year', 'residential_complexes'));
            }

            $developer_value = $developer;
            array_push($data, compact(
                'developer_value',
                'developer_advantages',
                'comments',
                'years'
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg',
        ]);

        $file = $request->file('logo');
        $name = date('dmyhis');
        $extension = $file->getClientOriginalExtension();
        $fullName = ($name . '.' . $extension);

        Storage::disk('local')->putFileAs('public/images/developers/', $file, $fullName);

        $developer = new Developer();
        $developer->logo = env("CLIENT_URL", 'http://localhost').'/storage/images/developers/' . $name . '.' . $extension;



        $developer->name = $request['name'];
        $developer->number = $request['number'];
        $developer->rating = $request['rating'];
        $developer->rating_votes = $request['rating_votes'];

        $developer->company_name = $request['company_name'];
        $developer->company_number = $request['company_number'];
        $developer->company_history = $request['company_history'];
        $developer->company_foundation_date = $request['company_foundation_date'];
        $developer->company_address = $request['company_address'];
        $developer->company_website = $request['company_website'];
        $developer->company_about_title = $request['company_about_title'];
        $developer->company_about_text = $request['company_about_text'];

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
        $data = [];
        $advantages = $developer->advantages('developer_id')->get();
        $developer_advantages = [];
        foreach ($advantages as $advantage_value) {
            $advantages_icons = $advantage_value->advantages_icons()->get();
            $advantage = $advantage_value;
            foreach ($advantages_icons as $advantage_icon) {
                $icon_id = Advantage::find($advantage_icon->icon_id);
            }
            array_push($developer_advantages, compact('advantage', 'advantages_icons'));
        }
        $comments = $developer->comments('developer_id')->get();
        $years = $developer->years('developer_id')->get();
        $developer_value = $developer;
        array_push($data, compact(
            'developer_value',
            'developer_advantages',
            'comments',
            'years'
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
        $developer = Developer::find($id);

        if ($request['logo']) {
            $developer->logo = env("CLIENT_URL", 'http://localhost').'/storage/images/developers/'.$request['logo'];
        }

        $developer->name = $request['name'];
        $developer->number = $request['number'];
        $developer->rating = $request['rating'];
        $developer->rating_votes = $request['rating_votes'];

        $developer->company_name = $request['company_name'];
        $developer->company_number = $request['company_number'];
        $developer->company_history = $request['company_history'];
        $developer->company_foundation_date = $request['company_foundation_date'];
        $developer->company_address = $request['company_address'];
        $developer->company_website = $request['company_website'];
        $developer->company_about_title = $request['company_about_title'];
        $developer->company_about_text = $request['company_about_text'];

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
            $logo_value = explode('/', $developer->logo);
            ob_start();
            echo end ($logo_value);
            $logo_name = ob_get_clean();

            File::delete('storage/images/developers/'.$logo_name);
            $developer->delete();
            return "This Developer was deleted";
        } else {
            return "This Developer was deleted erlier";
        }
    }
}
