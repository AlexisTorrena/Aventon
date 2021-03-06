<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //

    public function owner(){

        return $this->belongsTo('App\CustomUser','owner_id','id');
    }

    public function qualifier(){

        return $this->belongsTo('App\CustomUser','qualifier_id','id');
    }

    public function trip(){
        return $this->belongsTo('App\Trips','trip_id','id');
    }
}
