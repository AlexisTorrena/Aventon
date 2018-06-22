<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //

    protected $primaryKey = 'guid';
    
    public function getshareLinkAttribute()
    {
        return "http://localhost:8000/Trips/$this->id";
    }

    public function passengers(){
        
        return $this->belongsToMany('App\Customuser', 'trip_user', 'trip_id', 'user_id' );
    }

    public function postulations(){

        return $this->belongsToMany('App\Customuser', 'postulations', 'trip_id', 'user_id');
    }
}
