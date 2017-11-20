<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmentityType extends Model
{
    protected $fillable = ['name','token'];

    public function amentities(){
        return $this->hasMany('App\Amentity','amentity_type_id','id');
    }
}
