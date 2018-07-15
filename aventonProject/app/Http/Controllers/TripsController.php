<?php

namespace App\Http\Controllers;

use App\Trip as Trip;
use App\TripConfiguration as TripConfiguration;
use Illuminate\Http\Request;
use App\Quotation;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        $tripsToShow = collect(new Trip);
        //Show fake trips + real trips but removing duplicated ones.
        foreach ($configurations as $configuration)
        {
            $goshtTrips = $configuration->goshtTrips->keyBy('date');
            $realTrips = $configuration->trips->keyBy('date');
            $trips = $goshtTrips->merge($realTrips);
            $tripsToShow = $tripsToShow->concat($trips);
        }

        $trips = $tripsToShow;
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
        $tripConfiguration->custom_user_id = Auth::user()->id;

        $tripConfiguration->save();

        $tripConfiguration = new TripConfiguration;
        $configurations = $tripConfiguration->all();
        
        $tripsToShow = collect(new Trip);
        //Show fake trips + real trips but removing duplicated ones.
        foreach ($configurations as $configuration)
        {
            $goshtTrips = $configuration->goshtTrips->keyBy('date');
            $realTrips = $configuration->trips->keyBy('date');
            $trips = $goshtTrips->merge($realTrips);
            $tripsToShow = $tripsToShow->concat($trips);
        }

        $trips = $tripsToShow;
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

    public function postulate($tripConfig,$date,$tripId){
        $trips = new Trip;
        $trip;

        if($tripId > 0)
        {
          $trip = $trips->find($tripId);
        }
        else
        {
            $trips = new Trip;
            $trips->date = $date;
            $trips->trip_config_id = $tripConfig;
            $trips->status = 'Abierto';
            $trips->save();
            $trip = $trips;
        }
        
        $tripId = $trip->id;

        DB::table('postulations')->insert(
            ['user_id' => Auth::user()->id,
            'trip_id' => $tripId]
        );

        return back()->with('succesfuly', 'Te postulaste! Ahora tenés que esperar que el dueño de la publicación te acepte.');
        
    }

    public function detail($tripConfig,$date,$tripId){
        $trips = new Trip;
        $trip;

        if($tripId > 0)
        {
          $trip = $trips->find($tripId);
          $today = Carbon::today()->format('d-m-Y');

          if($trip->date < $today)
          {
            session()->flash('error', 'El viaje no esta disponible');  
            return back();
          }
        }
        else
        {
            //asigna el $date al primer trip que encuentra, solo para mostrar correctamente los datos.
            $trips = new TripConfiguration;
            $trip = $trips->find($tripConfig)->goshtTrips->first();
            $trip->date = $date;
        }
        
        return view('Trips/detail')->with('trip',$trip);
    }

    public function organized(){

        $tripConfiguration = new TripConfiguration;
        $userId = Auth::user()->id;
        $configs = $tripConfiguration->where('custom_user_id',$userId)->get();

        if ($configs->isEmpty()) {
         return view('Trips/withoutOrganizedTrips');
        }
        else
        {
            $tripsToShow = collect(new Trip);
            //Show only real trips
            foreach ($configs as $configuration) {
                $realTrips = $configuration->trips->keyBy('date');
                $tripsToShow = $tripsToShow->concat($realTrips);
            }

          $trips = $tripsToShow;
          return view('Trips/organizedTrips')->with('trips', $trips);
        }

    }
}