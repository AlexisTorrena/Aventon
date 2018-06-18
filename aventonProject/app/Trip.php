<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Trip extends Model
{
    //Accessors
    public function getdateAttribute()
    {
        $date = $this->attributes['date'];

        if(is_object($date))
        {
            $date = $date->format('d-m-Y');
        }

        return $date;
    }

    public function getshareLinkAttribute()
    {
        return "http://localhost:8000/Trips/$this->id";
    }

    public function getoriginAttribute()
    {
        return $this->TripConfiguration->origin;
    }

    public function getdestinationAttribute()
    {
        return $this->TripConfiguration->destination;
    }

    public function getdurationAttribute()
    {
        return $this->TripConfiguration->duration;
    }

    public function getcostAttribute()
    {
        return $this->TripConfiguration->cost;
    }

    public function getperiodicityAttribute()
    {
        return $this->TripConfiguration->periodicity;
    }

    public function getstartTimeAttribute()
    {
        return $this->TripConfiguration->startTime;
    }

    /**
    * Get the configuration that owns the trip.
    */
    public function tripConfiguration()
    {
        return $this->belongsTo('App\TripConfiguration', 'trip_config_id','id');
    }
}