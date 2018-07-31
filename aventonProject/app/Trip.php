<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Score;
use Illuminate\Support\Facades\Auth;
class Trip extends Model
{

   // protected $primaryKey = 'guid';
    
    //Accessors
    public function getdateAttribute()
    {
        $date = $this->attributes['date'];

        if(is_object($date))
        {
            $date = $date->format('d-m-Y');
        }
        else
        {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            $date = $date->format('d-m-Y');
        }

        return $date;
    }

    public function setdateAttribute($value)
    {
        if (!is_object($value)) 
        {
            $this->attributes['date'] = Carbon::createFromFormat('d-m-Y', $value);
        }
        else
        {
            $this->attributes['date'] = $value;
        }
    }

    public function getshareLinkAttribute()
    {
        return "http://localhost:8000/Trips/$this->id";
    }


    public function passengers(){
        
        return $this->belongsToMany('App\CustomUser', 'passengers', 'trip_id', 'user_id');
    }

    public function getpassengersToScoreAttribute(){

        $passengers = $this->passengers;

        $scores = $this->scores;

        $alreadyScored = collect([]);

        //set id of the trip owner as alredy score, just to not able to auto rate him self.
        $alreadyScored->push($this->TripConfiguration->owner->id);

        foreach ($scores as $score) 
        {
            $alreadyScored->push($score->owner_id);
        }

        $filtered = $passengers->whereNotIn('id',$alreadyScored);

        return $filtered; 
    }

    public function getalreadyRatedByMeAttribute()
    {
        //logged in user
       $userId = Auth::user()->id;
       
       $found = Score::where('trip_id','=',$this->id)->where('qualifier_id','=',$userId)->get();
        return !$found->isEmpty();
    }

    //calificaciones para el usuario $id, puede ser el owner o no, no importa
    public function scoresForUser($id)
    {
        $scores = Score::where('trip_id','=',$this->id)->where('owner_id','=',$id)->get();
        return $scores;
    }

    //calificaciones que dio el usuario $id, puede ser el owner o no, no importa
    public function myScores($id)
    {
        $scores = Score::where('trip_id','=',$this->id)->where('qualifier_id','=',$id)->get();
        return $scores;
    }

    public function postulations(){

        return $this->belongsToMany('App\CustomUser', 'postulations', 'trip_id', 'user_id');
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

    public function getIsRatableAttribute()
    {
        $cant = $this->passengers->count();
        $today = Carbon::today();
        $date = Carbon::createFromFormat('d-m-Y', $this->date);

        return $cant > 1 && $date->lt($today);
    }

    /**
    * Get the configuration that owns the trip.
    */
    public function tripConfiguration()
    {
        return $this->belongsTo('App\TripConfiguration', 'trip_config_id','id');
    }

    public function vehicle(){
        
        return $this->belongsTo('App\Vehicle');
    }
    public function questions(){
        
        return $this->hasMany('App\Question');
    }

    public function scores(){
        
        return $this->hasMany('App\Score');
    }
}
