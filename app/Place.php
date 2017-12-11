<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Place
 *
 * @property int $id
 * @property string $name
 * @property string $address1
 * @property string|null $address2
 * @property float $latitude
 * @property float $longitude
 * @property int $place_type_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PlaceInHood[] $announcements
 * @property-read \App\PlaceType $placeType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place wherePlaceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
