<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use SoftDeletes;

    protected $fillable = ['grade','comment','confirmed_at','user_id'];

    public function user(){
        return $this->belongsTo('App\User',"id","user_id");
    }
}
