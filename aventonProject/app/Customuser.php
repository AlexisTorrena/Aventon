<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
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

        return $this->belongsToMany('App\Trip', 'passengers', 'user_id', 'trip_id');
    }

    public function postulations(){

        return $this->belongsToMany('App\Trip', 'postulations', 'user_id', 'trip_id');
    }


    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function gethasReputationAttribute()
    {
        $scores = Score::where('owner_id','=',$this->id)->get();

      return $scores->count() > 2;
    }

    public function checkIfAvailable($date){
        
        $available = true;
        $carbonDate = new Carbon($date);
        $postulations = $this->postulations;
        $trips = $this->trips;
    
        foreach ($postulations as $postulation){
            
            $checkDate = new Carbon($postulation->date);
            
            if ($checkDate == $carbonDate){
                
                $available = false;
    
            }
        }

        foreach ($trips as $trip){

            $checkDate = new Carbon($trip->date);
        
            if ($checkDate == $carbonDate){
                
                $available = false;
                
            }
        }
        
        return $available;
    }

    public function getavergeReputationAttribute()
    {
        $scores = Score::where('owner_id','=',$this->id)->get();
        $scoresValues = collect([]);

        foreach ($scores as $score) 
        {
            $scoresValues->push($score->value);
        }

        $reputation = $scoresValues->avg();
        //redonde entre numero entero ej: 3 y 3.5 . 
        $reputation = floor($reputation);

      return $reputation;
    }
}
