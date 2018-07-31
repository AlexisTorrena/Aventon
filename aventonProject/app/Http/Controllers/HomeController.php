<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip as Trip;
use Carbon\Carbon;

use App\TripConfiguration as TripConfiguration;

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

    public function filters(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $dates = $request->input('dates');
        // $tripConfiguration = TripConfiguration::all();
        $tripConfiguration = TripConfiguration::where([
                                                        ['origin', 'like', '%'.$origin.'%'],
                                                        ['destination', 'like', '%'.$destination.'%'],
                                                      ])->get();
       //dd($destination, $origin , $dates, $tripConfiguration);
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
        if ($dates){
            $dateSearch = Carbon::parse($dates)->format('d-m-Y');
            $tripsToShow = $tripsToShow->where('date', '=', $dateSearch);
        }else{
          $dateSearch = null;
        }
        // dd($tripsToShow, $dateSearch);
        $trips = $tripsToShow;
        $filter = array('date' => $dateSearch, 'origin' => $origin, 'destination' => $destination);
        // dd($filter);

        if($trips){
          if ( $trips->count() > 0 ){
            return view('Trips/index')->with('trips',$trips)->with('filter',$filter);
          }else{
            $msg = 'No se encontraron viajes disponibles';
            return view('Trips/errSearch')->with('msg',$msg);
          }
        }
    }

    public function prueba(){

        return view('Trips/tripprueba');
    }

    public function regCompleted()
    {
        return view('registrationCompleted');
    }
}
