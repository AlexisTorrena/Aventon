<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TripConfiguration extends Model
{
    public function setstartDateAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['startDate'] = Carbon::createFromFormat('d/m/Y', $value);
        }
    }

    public function setendDateAttribute($value)
    {
        if (!empty($value)) 
        {
            $this->attributes['endDate'] = Carbon::createFromFormat('d/m/Y', $value);
        }
    }

    public function getstartDateAttribute()
    {
        $date = $this->attributes['startDate'];
        return Carbon::createFromFormat('Y-m-d', $date);
    }

    public function getendDateAttribute()
    {
        $date = $this->attributes['endDate'];
        return Carbon::createFromFormat('Y-m-d', $date);
    }
    //
    /**
    * Get the trips for the TripConfiguration post.
    */
    public function trips()
    {
        return $this->hasMany('App\Trip','trip_config_id');
    }

    public function getgoshtTripsAttribute()
    {
        $gTrips = collect(new Trip);
        $cantOfDays = 0;
        switch ($this->periodicity) {
            case "Unica":
                $trip = new Trip;
                $trip->trip_config_id= $this->id;
                $trip->date = $this->startDate->copy();
                $trip->status = 'Abierto';
                $trip->id = 0;
                $gTrips->push($trip);
                break;
            case "Diaria":
                //<= becasue if same day it will be zero
                $cantOfDays = $this->startDate->diffInDays($this->endDate);
                for ($x = 0; $x <= $cantOfDays; $x++) {
                    $trip = new Trip;
                    $trip->trip_config_id= $this->id;
                    $trip->date = $this->startDate->copy()->addDay($x);
                    $trip->status = 'Abierto';
                    $trip->id = 0;
                    $gTrips->push($trip);
                } 
                break;
            case "Semanal":
                    //<= becasue if same day it will be zero
                    $cantOfweeks = $this->startDate->diffInWeeks($this->endDate);

                    for ($x = 0; $x <= $cantOfweeks; $x++) {
                        $trip = new Trip;
                        $trip->trip_config_id= $this->id;
                        $trip->date = $this->startDate->copy()->addWeeks($x);
                        $trip->status = 'Abierto';
                        $trip->id = 0;
                        $gTrips->push($trip);
                    } 
                    break;
            case "Mensual":
                    //<= becasue if same day it will be zero
                    $cantOfMonths = $this->startDate->diffInMonths($this->endDate);

                    for ($x = 0; $x <= $cantOfMonths; $x++) {
                        $trip = new Trip;
                        $trip->trip_config_id= $this->id;
                        $trip->date = $this->startDate->copy()->addMonths($x);
                        $trip->status = 'Abierto';
                        $trip->id = 0;
                        $gTrips->push($trip);
                    } 
                    break;              
            default:
                //echo "Your favorite color is neither red, blue, nor green!";
            }
        return $gTrips;    
    }

    public function owner(){

        return $this->belongsTo('App\CustomUser','custom_user_id','id');
    }

    public function vehicle(){

        return $this->belongsTo('App\Vehicle');
    }
}
