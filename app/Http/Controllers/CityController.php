<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities($stateId)
    {
        $cities = City::select('name', 'id')->where('state_id', $stateId)->get();

        return response()->json([
            'success' => true,
            'cities' => $cities->toArray(),
        ], 200);
    }

    public function getCountryCities($countryId) {
        $cities = City::select('name', 'id')->where('country_id', $countryId)->get();

        return response()->json([
            'success' => true,
            'cities' => $cities->toArray(),
        ], 200);
    }

    // public function getCityOrder($cityId) {
    //     $ordres = Order::with('city')->get();

    //     // return $ordres;
    //     return response()->json([
    //         'success' => true,
    //         'cities' => $ordres->toArray(),
    //     ], 200);
    // }
}
