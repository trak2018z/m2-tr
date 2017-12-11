<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ["message","code","line"];

    public static function logError($message, $code = 0, $line = 0){
        if(!is_string($message)){
            $message = json_encode($message);
        }
        Log::create([
            "message" => $message,
            "code" => $code,
            "line" => $line,
        ]);
    }

    public static function logSuccess($message, $line = 0){
        if(!is_string($message)){
            $message = json_encode($message);
        }
        Log::create([
            "message" => $message,
            "code" => 200,
            "line" => $line,
        ]);
    }

    public static function logMessage($message, $line = 0){
        if(!is_string($message)){
            $message = json_encode($message);
        }
        Log::create([
            "message" => $message,
            "code" => 0,
            "line" => $line,
        ]);
    }
}
