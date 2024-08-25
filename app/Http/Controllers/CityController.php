<?php

namespace App\Http\Controllers;

use App\Models\City;
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
}
