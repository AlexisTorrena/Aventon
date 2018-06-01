<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


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
}
