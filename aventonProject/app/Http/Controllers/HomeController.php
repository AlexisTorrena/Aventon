<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip as Trip;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trip = new Trip;
        $trips = $trip->all();
        return view('Trips/index')->with('trips',$trips);
    }

    public function prueba(){

        return view('Trips/tripprueba');
    }

    public function regCompleted()
    {
        return view('registrationCompleted');
    }
}
