<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Validator;


class CitiesController extends Controller
{
    //

    public function getCities()
    {
    	return response()->json(City::get());
    }

    public function addCity(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'city_name' => 'required|unique:cities',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        City::create($req->all());
        return response()->json('Город добавлен');
    }

    public function updateCity(Request $req)
    {
        $city = City::where("id",$req->id)->first();

        if(!$city)
            return response()->json("Запись не найдена");
        
        $city->update($req->all());
        return response()->json("Запись изменена");
    }

    public function deleteCity(Request $req)
    {
        $city = City::where("city_name", $req->city_name)->first();

        if(!$city)
            return response()->json("Город не найден");
        
        $city->delete();
        return response()->json("Город удален");
    }

}
