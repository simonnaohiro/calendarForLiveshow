<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';


    protected $fillable = [
        'user_id', 'image_icon', 'introduction',
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
