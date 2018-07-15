<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAtributte($value='')
    {
      return \Auth::user()->name;
    }

    public function getBirthDateAtributte($value='')
    {
      return \Auth::user()->birthDate;
    }

    public function vehicles()
    {
    return $this->hasMany('App\Vehicle');
    }

    public function tripsConfigs()
    {
    return $this->hasMany('App\TripConfiguration', 'trip_config_id','id');
    }

    public function saveVehicle($idUser, $idVehicle)
    {

    }

    public function questions(){

        return $this->hasMany('App\Questions');
    }
}
