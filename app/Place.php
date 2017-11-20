<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['name','address1','address2','latitude','longitude','place_type_id'];

    public function placeType(){
        return $this->belongsTo('App\PlaceType','place_type_id','id');
    }

    public function announcements(){
        return $this->hasManyThrough('App\PlaceInHood','App\Announcement','place_id','announcement_id','id','id');
    }
}
