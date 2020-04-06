<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type'
    ];

    /**
     * The users that belong to the role.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
