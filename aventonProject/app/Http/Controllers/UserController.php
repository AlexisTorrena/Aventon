<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customuser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $user = \Auth::user();
      //$user = User::where('id' = $id)
      return view('User/userProfile')->with('user',$user);
    }

    public function showVehicles(){

      $vehicles = Auth::user()->vehicles;
      if ($vehicles->isEmpty()) {
       return view('Vehicle/withoutVehicles');
      }else{
        return view('Vehicle/index')->with('vehicles',$vehicles);
      }
    }

    public function showProfile($idUser)
    {
      $user = new Customuser;
      $users = $user->all();
      $user = $users->find($idUser);
      return view('User/userProfile')->with('user',$user);
    }

    public function showTrips(){

        $trips = Auth::user()->trips;

        if(!$trips->isEmpty())
        {
            return view('User/myTrips')->with('trips',$trips);
        }
        else
        {
            return view('User/withoutTrips');
        }
    }

    public function showPostulations(){

        $postulations = Auth::user()->postulations;

        if(!$postulations->isEmpty())
        {
            return view('User/myPostulations')->with('postulations',$postulations);
        }
        else
        {
            return view('User/withoutPostulations');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
