<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function unauthorized(Request $request){
        return response()->json([
            "response" => "Unauthorized.",
        ],401);
    }
}
