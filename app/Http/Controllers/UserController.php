<?php

namespace App\Http\Controllers;

use App\Log;
use App\Mail\SendActivationLink;
use App\Role;
use App\User;
use Auth;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Mail;
use Validator;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $http = new Client;
        $url = app()->environment() == "local" ? "{$request->getHost()}:8001/auth/token" : url('/auth/token');
        $response = $http->post($url, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => 2,
                'client_secret' => env('PASSPORT_SECRET'),
                'username' => $request->username,
                'password' => $request->password,
                'scope' => '',
            ],
            'timeout' => 5,
            "http_errors" => false,
        ]);
        return response()->json(json_decode($response->getBody()));
    }

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|boolean'
        ]);

        if ($validator->errors()->any()) {

            $errors = [];
            foreach ($validator->errors()->all() as $key => $error) {
                $errors[] = [ $validator->errors()->keys()[$key] => $error];
            }

            return response()->json([
                "success" => false,
                "response" => [
                    "errors" => $errors,
                    "message" => "ERROR_VALIDATION"
                ]
            ], 400);
        }

        try {

            if ($request->role) {
                $role_id = Role::where('token', '=', 'ROLE_OWNER')->first()->id;
            } else {
                $role_id = Role::where('token', '=', 'ROLE_USER')->first()->id;
            }

            $user = User::create([
                "name" => $request->username,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "role_id" => $role_id,
                "active" => 0,
                "hash" => str_random(32)
            ]);

            //Mail::queue(new SendActivationLink($user));
            Mail::send(new SendActivationLink($user));

            return response()->json([
                "success" => true,
                "response" => [
                    "message" => "SUCCESS_OK_ACTIVATE_ACCOUNT"
                ]
            ], 201);

        } catch (Exception $e) {

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function me()
    {
        return $this->show(Auth::id());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->role;
        return response()->json([
            "success" => true,
            "response" => [
                "user" => $user
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Activate new user
     * @param Request $request
     * @param User $newUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Request $request, User $newUser){
        $newUser->hash = null;
        $newUser->active = true;
        if($newUser->save()){
            return response()->json([
                "success" => true,
                "response" => [
                    "message" => "SUCCESS_OK_USER_ACTIVATED"
                ]
            ], 200);
        } else {
            return response()->json([
                "success" => true,
                "response" => [
                    "message" => "ERROR_ACTIVATION_ERROR"
                ]
            ], 500);
        }
    }
}
