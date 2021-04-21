<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\Validator;


class FlightsController extends Controller
{
    //

    public function getFlights()
    {
    	return response()->json(Flight::get());
    }

    public function addFlight(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'flight_from' => 'required',
            'flight_to' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        Flight::create($req->all());
        return response()->json('Рейс добавлен');
    }

    public function updateFlight(Request $req)
    {
        $flight = Flight::where("id",$req->id)->first();

        if(!$flight)
            return response()->json("Запись не найдена");
        
        $flight->update($req->all());
        return response()->json("Запись изменена");
    }

    public function deleteFlight(Request $req)
    {
        $flight = Flight::where("id", $req->id)->first();

        if(!$flight)
            return response()->json("Рейс не найден");
        
        $flight->delete();
        return response()->json("Рейс удален");
    }

}
