<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'customusers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','birthDate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function trips(){

        return $this->belongsToMany('App\Trip', 'trip_user', 'user_id', 'trip_id');
    }

    public function postulations(){

        return $this->belongsToMany('App\Trip', 'postulations', 'user_id', 'trip_id');
    }


    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

}
