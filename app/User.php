<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hootlex\Friendships\Traits\Friendable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'social_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role');
    }

    public function isAdmin() 
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function medias() 
    {
        return $this->hasMany('App\Media', 'user_id');
    }

    public function personalInfo() 
    {
        return $this->hasOne('App\UsersPersonalInfo', 'user_id')->first();
    }

    public function hobby() 
    {
        return $this->hasOne('App\Hobby', 'user_id')->first();
    }

    public function fullName() 
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function fullLocation() 
    {
        $personalInfo = $this->personalInfo();

        if ($personalInfo) {   
            return implode(', ', array(  $personalInfo->getCity(), $personalInfo->getState(), $personalInfo->getCountry()));
        }
        return 'None';
    }

    public function profilePhoto()
    {
        $profileMedia = $this->medias()->where('type', 'profile')->first();
        return $profileMedia ? $profileMedia->url : 'img/avatar1.jpg';
    }

    public function headerPhoto()
    {
        $headerMedia = $this->medias()->where('type', 'header')->first();
        return $headerMedia ? $headerMedia->url : 'img/friend1.jpg';
    }
}
