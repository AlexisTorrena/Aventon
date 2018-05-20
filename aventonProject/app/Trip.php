<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    public function getshareLinkAttribute()
    {
        return "http://localhost:8000/Trips/$this->id";
    }
}
