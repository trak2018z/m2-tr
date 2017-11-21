<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','token','permissions'];

    protected $hidden = ['created_at','updated_at','token'];

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
