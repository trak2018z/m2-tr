<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AnnouncementImage
 *
 * @property int $id
 * @property string $path
 * @property string $thumb_path
 * @property string $title
 * @property string $mime
 * @property string $extension
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage whereThumbPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AnnouncementImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AnnouncementImage extends Model
{
    protected $visible = ['path','thumb_path','title','mime','extensions','created_at'];

    protected $fillable = ['path','thumb_path','title','mime','extension', 'main', 'announcement_id'];
}
