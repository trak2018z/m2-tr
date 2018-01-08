<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementImage;
use App\Log;
use Auth;
use DB;
use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Throwable;

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
            $max_main_image = count($request->images);
            $this->validate($request, [
                "title" => "required|min:10|max:120",
                "description" => "required|min:10|max:10000",
                "latitude" => "required",
                "longitude" => "required|longitude:latitude",
                "max_persons" => "required|integer|min:1",
                "dimension" => "required|integer|min:1",
                "phone" => "required|phone:AUTO,PL",
                "email" => "nullable|email",
                "main_image" => "required|min:0|max:{$max_main_image}",
                "announcement_type_id" => "required|exists:announcement_types,id",
                "amentity_ids" => "present|array",
                "amentity_ids.*" => "exists:amentities,id",
                "images" => "present|array|min:1",
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
            DB::transaction(/**
             * @throws Exception
             */
                function() use ($request) {
                // Create Announcement
                $user = Auth::user();
                $announcement = Announcement::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'address_short' => "",
                    'address' => "",
                    'max_persons' => $request->max_persons,
                    'dimension' => $request->dimension,
                    'phone' => $request->phone ?? $user->phone,
                    'email' => $request->email ?? $user->email,
                    'user' => $user->id,
                    'announcement_type_id' => $request->announcement_type_id,
                ]);

                // Handle amentities
                $announcement->amentities()->attach($request->amentity_ids);
                // Handle images
                $main_image = 0;
                if (count($request->images)) {
                    foreach ($request->images as $idx => $image) {
                        /**
                         * @var $image UploadedFile
                         */
                        if (!$image->isValid()) {
                            throw new Exception("Plik/i został przesłany niepoprawnie.");
                        }
                        $extension = $image->getClientOriginalExtension();
                        $filename = time() . '_' . rand(1, 10000) . '.' . $extension;
                        $img = Image::make($image->getRealPath());

                        $thumbPath = "/images/announcements/thumbs/" . $filename;
                        $img->fit(445)->save(public_path() . $thumbPath, 75);

                        $img = Image::make($image->getRealPath());
                        $imagePath = "/images/announcements/images/" . $filename;
                        $img = $img->fit(1920);
                        $img->save(public_path() . $imagePath, 85);

                        AnnouncementImage::create([
                            'path' => $imagePath,
                            'thumb_path' => $thumbPath,
                            'title' => '',
                            'mime' => $img->mime(),
                            'extension' => $extension,
                            'main' => $main_image == $request->main_image,
                            'announcement_id' => $announcement->id,
                        ]);

                        $main_image++;
                    }
                }
            });

            return response()->json([
                "success" => true,
                "response" => [
                    "message" => "ANNOUNCEMENT_CREATED"
                ]
            ], 201);
        } catch(Exception $e){
            Log::logError($e->getMessage(). " in ". $e->getFile(), intval($e->getCode()), $e->getLine());

            return response()->json([
                "success" => false,
                "response" => [
                    "message" => "ERROR_OCCURED"
                ]
            ], 500);
        } catch(Throwable $e){
            Log::logError($e->getMessage(). " in ". $e->getFile(), intval($e->getCode()), $e->getLine());

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
