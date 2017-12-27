<?php

namespace App\Http\Controllers;

use App\Amentity;
use Illuminate\Http\Request;

class AmentityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "success" => false,
            "response" => [
                "amentities" => Amentity::join('amentity_types','amentity_types.id','=','amentities.amentity_type_id')
                    ->orderBy('amentity_types.id','asc')
                    ->orderBy('name','asc')
                    ->select([
                        'amentities.*',
                        'amentity_types.name as amentity_type',
                        'amentity_types.token as amentity_type_token'
                    ])
                    ->get()->mapToGroups(function ($item, $key) {
                        return [$item['amentity_type_token'] => $item];
                    })
            ]
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
    public function store(Request $request)
    {
        //
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
