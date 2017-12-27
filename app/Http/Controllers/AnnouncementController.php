<?php

namespace App\Http\Controllers;

use App\Log;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                "title" => "required|min:10|max:120",
                "description" => "required|min:10|max:10000",
                "latitude" => "required",
                "longitude" => "required|longitude:latitude",
                "max_persons" => "required|integer|min:1",
                "dimension" => "required|integer|min:1",
                "phone" => "required|phone:AUTO,PL",
                "email" => "required|email",
                "announcement_type_id" => "required|exists:annoucement_type,id",
                "amentity_ids" => "present|array",
                "amentity_ids.*" => "exists:amentities,id",
                "images" => "present",
                "images.*" => "image|mimes:jpeg,bmp,png|max:2048",
            ]);

        } catch(ValidationException $e){
            return response()->json([
                "success" => false,
                "response" => [
                    "errors" => $e->errors(),
                    "message" => "ERROR_VALIDATION"
                ]
            ], 400);
        }

        try{
            DB::transaction(function() use ($request) {
                // Create Announcement
                $announcement = Announcement::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'address_short' => "",
                    'address' => "",
                    'max_persons' => $request->max_persons,
                    'dimension' => $request->dimension,
                    'phone' => $request->dimension,
                    'email' => $request->email,
                    'user' => Auth::id(),
                    'announcement_type_id' => $request->announcement_type_id,
                ]);
                // Handle images

                // Handle amentities
            });
        } catch(Exception $e){
            Log::logError($e->getMessage(). " in ". $e->getFile(), $e->getCode(), $e->getLine());

            return response()->json([
                "success" => false,
                "response" => [
                    "message" => "ERROR_OCCURED"
                ]
            ], 500);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
