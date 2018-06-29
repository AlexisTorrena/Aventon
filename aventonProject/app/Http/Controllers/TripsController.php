<?php

namespace App\Http\Controllers;

use App\Trip as Trip;
use App\TripConfiguration as TripConfiguration;
use Illuminate\Http\Request;
use App\Quotation;
use DB;
use Illuminate\Support\Facades\Auth;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tripConfiguration = new TripConfiguration;
        $configurations = $tripConfiguration->all();

        $trips = collect(new Trip);
        foreach ($configurations as $configuration)
        {
            $temp = $configuration->trips;
            $trips = $trips->concat($temp);
            $temp = $configuration->goshtTrips;
            $trips = $trips->concat($temp);
        }

        return view('Trips/index')->with('trips',$trips);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Trips/newTrip');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tripConfiguration = new TripConfiguration;
        $tripConfiguration->origin = $request->input('origin');
        $tripConfiguration->destination = $request->input('destination');
        $tripConfiguration->startTime = $request->input('startTime');
        $tripConfiguration->cost = $request->input('cost');
        $tripConfiguration->duration = $request->input('duration');
        $tripConfiguration->startDate = $request->input('startDate');
        $tripConfiguration->endDate = $request->input('endDate');
        $tripConfiguration->periodicity = $request->input('periodicity'); 

        $tripConfiguration->save();

        $tripConfiguration = new TripConfiguration;
        $configurations = $tripConfiguration->all();

        $trips = collect(new Trip);
        foreach ($configurations as $configuration)
        {
            $temp = $configuration->trips;
            $trips = $trips->concat($temp);
            $temp = $configuration->goshtTrips;
            $trips = $trips->concat($temp);
        }

        return view('Trips/index')->with('trips',$trips);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function postulate($id){

        DB::table('postulations')->insert(
            ['user_id' => Auth::user()->id,
            'trip_id' => $id]
        );

        return back()->with('succesfuly', 'Te postulaste! Ahora tenés que esperar que el dueño de la publicación te acepte.');
        
    }

    public function detail($tripConfig,$date,$tripId){
        $trips = new Trip;
        $trip;

        if($tripId > 0)
        {
          $trip = $trips->find($tripId);
        }
        else
        {
            $trips = new TripConfiguration;
            $trip = $trips->find($tripConfig)->goshtTrips->first();
            $trip->date = $date;
        }
        
        return view('Trips/detail')->with('trip',$trip);
    }
}
