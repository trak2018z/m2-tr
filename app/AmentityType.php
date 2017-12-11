<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AmentityType
 *
 * @property int $id
 * @property string $name
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Amentity[] $amentities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AmentityType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AmentityType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AmentityType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AmentityType whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AmentityType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AmentityType extends Model
{
    protected $fillable = ['name','token'];

    public function amentities(){
        return $this->hasMany('App\Amentity','amentity_type_id','id');
    }
}
