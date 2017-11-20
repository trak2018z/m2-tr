<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amentity extends Model
{
    protected $fillable = ['name','token', 'amentity_type_id'];

    public function amentityType(){
        return $this->belongsTo('App\AmentityType','amentity_type_id','id');
    }
}
