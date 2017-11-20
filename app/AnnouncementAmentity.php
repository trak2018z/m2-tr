<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AnnouncementAmentity extends Pivot
{
    protected $fillable = ['announcement_id','amentity_id'];
}
