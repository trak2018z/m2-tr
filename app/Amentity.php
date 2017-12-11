<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Amentity
 *
 * @property int $id
 * @property string $name
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $amentity_type_id
 * @property-read \App\AmentityType $amentityType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AnnouncementAmentity[] $announcements
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Amentity whereAmentityTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Amentity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Amentity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Amentity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Amentity whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Amentity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Amentity extends Model
{
    protected $fillable = ['name','token', 'amentity_type_id'];

    public function amentityType(){
        return $this->belongsTo('App\AmentityType','amentity_type_id','id');
    }

    public function announcements(){
        return $this->hasManyThrough('App\AnnouncementAmentity','App\Announcement','amentity_id','announcement_id','id','id');
    }
}
