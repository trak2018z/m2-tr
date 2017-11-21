<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rates(){
        return $this->hasMany('App\Rate','user_id','id');
    }

    public function announcements(){
        return $this->hasMany('App\Announcement','user','id');
    }

    public function role(){
        return $this->hasOne('App\Role','id','role_id');
    }

    public function hasRole($roles)
    {
        $role = $this->role;
        // Check if the user is a root account
        if($role->token == 'ADMIN_ROLE' || empty($roles)) {
            return true;
        }
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->checkIfUserHasRole($need_role, $role)) {
                    return true;
                }
            }
        } else{
            return $this->checkIfUserHasRole($roles, $role);
        }
        return false;
    }

    private function checkIfUserHasRole($need_role, $role)
    {
        return (strtolower($need_role)==strtolower($role->name)) ? true : false;
    }
}
