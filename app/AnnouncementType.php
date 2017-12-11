<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AnnouncementType
 *
 * @property int $id
 * @property string $name
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementType whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AnnouncementType extends Model
{
    protected $fillable = ['name','token'];
}
