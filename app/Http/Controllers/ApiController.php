<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function redirect(Request $request){
        return redirect()->route('log_in');
    }
}
