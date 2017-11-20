<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    protected $fillable = ['name','token'];

    public function places(){
        return $this->hasMany('App\Place','place_type_id','id');
    }

}
