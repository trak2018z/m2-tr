<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PlaceType
 *
 * @property int $id
 * @property string $name
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Place[] $places
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlaceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlaceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlaceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlaceType whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlaceType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlaceType extends Model
{
    protected $fillable = ['name','token'];

    /**
     * The attributes that should be visible for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id', 'name','token'
    ];

    public function places(){
        return $this->hasMany('App\Place','place_type_id','id');
    }

}
