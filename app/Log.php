<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Log
 *
 * @property int $id
 * @property string $message
 * @property int $code
 * @property string|null $line
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
