<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Vehicle extends Model
{

    public $timestamps = false;

    protected $table = 'vehicle';
    protected $fillable = [
        'brand', 'model', 'patent', 'seats'
    ];

     public function create()
     {
     }
     
     public function getSeats(){

        return $this->seats;
     }
     public function trips(){
    
        return $this->hasMany('App\Trip');
    }

     public function owner(){

         return $this->belongsTo('App\Customusers');
     }

}
