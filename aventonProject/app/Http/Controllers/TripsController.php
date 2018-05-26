<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip as Trip;

class TripsController extends Controller
{
    public function index()
    {
        $trip = new Trip;
        $trips = $trip->all();

        return view('Trips/index')->with('trips',$trips);
    }

    public function details($id)
    {
        return view('Trips/details');
    }
}
