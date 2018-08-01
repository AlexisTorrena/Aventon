<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle as Vehicle;
use Illuminate\Support\Facades\Auth;
use App\TripConfiguration as TripConfiguration;



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
     $vehicle -> custom_user_id = Auth::user()->id;
     if($vehicle->save()){
        return back()->with('succesfuly', 'Vehiculo registrado');
     }else{
       return back()->with('error', 'Error al registrar el vehiculo, por favor intente de nuevo!');
     }
  }

  public function index()
  {
      $vehicle = new Vehicle;
      $vehicle = (array)$vehicle->all();
       if (true) {
        return view('Vehicle/withoutVehicles');
       }else{
         return view('Vehicle/index')->with('vehicles',$vehicle);
       }
  }

  public function modifyVehicle($idVehicle)
  {
    $vehicle = new Vehicle;

    if( $this->checkOwner($idVehicle) ){
      $vehic = $this->isVehicleUsed($idVehicle);
      if ($vehic->count() > 0){
        return view('Vehicle/errorAccion')->with('mensaje', 'El vehículo está siendo usado en un viaje');
      }else{
      $vehicle = Vehicle::where('id', $idVehicle)->get();
      return view('Vehicle/modifyVehicle')->with('vehicles',$vehicle->first());
    }
    }else{
       return view('Vehicle/errorAccion')->with('mensaje', 'No tenés permisos para modificar este vehículo');
    }
  }

  public function removeVehicle($idVehicle)
  {
    $vehicle = new Vehicle;
    if($this->checkOwner($idVehicle)){
      $vehic = $this->isVehicleUsed($idVehicle);
      if ($vehic->count() > 0){
        return view('Vehicle/errorAccion')->with('mensaje', 'El vehículo está siendo usado en un viaje');
      }else{
        $vehicle = Vehicle::destroy($idVehicle);
        $this->index();
        return view('Vehicle/succesAction')->with('mensaje', 'Se borró el vehículo');
      }
      }
      // if ($isUsedInATrip = $trip->vehicles->where(''))
      else{
      return view('Vehicle/errorAccion')->with('mensaje', 'No tenés permisos para eliminar este vehículo');
   }
  }

  public function storeModify(Request $request)
  {
    $idVehicle = $request->input('idVehicle');
    $vehicle = Vehicle::find($idVehicle);
    $vehicle->brand = $request -> input('brandVehicle');
    $vehicle->model = $request -> input('modelVehicle');
    $vehicle->patent = $request -> input('patentVehicle');
    $vehicle->seats = $request -> input('numberOfSeats');
    if($vehicle->save()){
       return back()->with('succesfuly', 'Vehiculo modificado');
    }else{
      return back()->with('error', 'Error al modificar el vehiculo, por favor intente de nuevo!');
    }
  }

  public function checkOwner($idVehicle)
  {
    return (Auth::user()->vehicles->find($idVehicle) ) ;
    //return ($usr->where('id', $idVehicle));
  }

  public function isVehicleUsed($idVehicle)
  {
    $configurations = TripConfiguration::all();
    $trips = $configurations->where('vehicle_id',$idVehicle);
    return ($trips);
  }

}
