<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPersonalInfo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_personal_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * The users that belong to the role.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function getCountry()
    {
        $country = $this->country();
        return $country ? $country->first()->name : '';
    }

    public function getState()
    {
        $state = $this->state();
        return $state ? $state->first()->name : '';
    }

    public function getCity()
    {
        $city = $this->city();
        return $city ? $city->first()->name : '';
    }
}
