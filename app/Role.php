<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','token','permissions'];

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
