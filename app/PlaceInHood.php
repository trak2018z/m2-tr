<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlaceInHood extends Pivot
{
    protected $fillable = ['announcement_id','place_id','distance'];
}
