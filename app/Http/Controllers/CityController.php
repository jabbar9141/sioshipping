<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Dispatcher;
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

    public function getOrder() {
        $ordres = Order::select('id', 'tracking_id')->where('status', 'placed')->get();
       
        // return $ordres;
        return response()->json([   
            'success' => true,
            'ordres' => $ordres->toArray(),
        ], 200);
    }

  
    public function editCountriy() {
        $countries = Country::select('name', 'id')->get();
        return response()->json([
            'success' => true,
            'countries' => $countries->toArray(),
        ], 200);
    }

}
