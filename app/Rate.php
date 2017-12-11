<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Rate
 *
 * @property int $id
 * @property int $grade Grade from 0 to 50
 * @property string|null $comment
 * @property int $user_id
 * @property string|null $confirmed_at
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $announcement_id
 * @property-read \App\Announcement $announcement
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Rate onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereAnnouncementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rate whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Rate withoutTrashed()
 * @mixin \Eloquent
 */
class Rate extends Model
{
    use SoftDeletes;

    protected $fillable = ['grade','comment','confirmed_at','user_id', 'announcement_id'];

    public function user(){
        return $this->belongsTo('App\User',"id","user_id");
    }

    public function announcement(){
        return $this->belongsTo('App\Announcement',"id","announcement_id");
    }
}
