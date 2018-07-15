<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;

    protected $table = 'questions';
    protected $fillable = [
        'question', 'answer'
    ];

     public function create()
     {
     }

     public function owner(){

         return $this->belongsTo('App\Customusers');
     }

     public function trip(){
         return $this->belongsTo('App\Trip');
     }
}
