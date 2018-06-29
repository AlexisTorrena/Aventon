<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle as Vehicle;

class VehicleController extends Controller
{

  public function show($value='')
  {
    // Mostrar detalle vehículo
  }

  public function register()
  {
    // code...
    return view('Vehicle/registerVehicle');
  }

  public function store(Request $request)
  {
     $vehicle = new Vehicle;
     $vehicle -> brand = $request -> input('brandVehicle');
     $vehicle -> model = $request -> input('modelVehicle');
     $vehicle -> patent = $request -> input('patentVehicle');
     $vehicle -> seats = $request -> input('numberOfSeats');
     if($vehicle->save()){
        UserController::saveVehicle($vehicle->id );
        return back()->with('succesfuly', 'Vehiculo registrado');
     }else{
       return back()->with('error', 'Error al registrar el vehiculo, por favor intente de nuevo!');
     }
  }

  public function index()
  {
      $vehicle = new Vehicle;
      $vehicle = $vehicle->all();

      return view('Vehicle/index')->with('vehicles',$vehicle);
  }
}
