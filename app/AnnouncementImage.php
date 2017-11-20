<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnouncementImage extends Model
{
    protected $fillable = ['path','thumb_path','title','mime','extension'];
}
