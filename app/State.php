<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    
    ];

    /**
     * The users that belong to the role.
     */
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function cities()
    {
        return $this->hasMany('App\City', 'state_id');
    }

    public function personalInfos()
    {
        return $this->hasMany('App\UsersPersonalInfo', 'state_id');
    }
}
