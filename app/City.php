<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

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
    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }

    public function personalInfos()
    {
        return $this->hasMany('App\UsersPersonalInfo', 'city_id');
    }
}
