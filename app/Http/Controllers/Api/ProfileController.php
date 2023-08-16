<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileCreateRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::all();
        if (count($profile) < 1) {
            return response()->json([
                "message" => "Data tidak ditemukan",
                "status" => 'error',
            ], 401);
        }

        return response()->json([
            "message" => "Show all data Successfully",
            "status" => "success",
            "profile" => $profile
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileCreateRequest $request)
    {

        $profile = new Profile();
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->save();

        return response()->json([
            "message" => "Created Successfully",
            "status" => "success",
            "profile" => $profile
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json([
                "message" => "Data tidak ditemukan",
                "status" => 'error',
            ], 401);
        }

        return response()->json([
            "message" => "Show data by id Successfully",
            "status" => "success",
            "profile" => $profile
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json([
                "message" => "Data tidak ditemukan",
                "status" => 'error',
            ], 401);
        }

        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->save();

        return response()->json([
            "message" => "Updated successfully",
            "status" => "success",
            "profile" => $profile
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json([
                "message" => "Data tidak ditemukan",
                "status" => 'error',
            ], 401);
        }

        $profile->delete();

        return response()->json([
            "message" => "Deleted Successfully",
            "status" => "success",
            "profile" => $profile
        ], 200);
    }
}
