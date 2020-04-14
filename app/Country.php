<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

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
    public function personalInfos()
    {
        return $this->hasMany('App\UsersPersonalInfo', 'country_id');
    }

    public function states()
    {
        return $this->hasMany('App\State', 'country_id');
    }
}
