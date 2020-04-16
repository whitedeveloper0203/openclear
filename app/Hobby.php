<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hobby';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'txt_hobbies', 
        'txt_favorite_music', 
        'txt_favorite_tv', 
        'txt_favorite_book', 
        'txt_favorite_writer', 
        'txt_favorite_game', 
        'txt_other_interest', 
        'txt_favorite_movie'
    ];

    /**
     * The users that belong to the role.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
