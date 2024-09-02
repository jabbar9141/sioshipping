<?php

namespace App\Http\Controllers;

use App\Models\Batchlog;
use App\Models\BatchorderLog;
use App\Models\City;
use App\Models\Country;
use App\Models\Dispatcher;
use App\Models\Order;
use App\Models\OrderBatch;
use Illuminate\Bus\Batch;
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

    public function getCountryCities($countryId)
    {
        $cities = City::select('name', 'id')->where('country_id', $countryId)->get();

        return response()->json([
            'success' => true,
            'cities' => $cities->toArray(),
        ], 200);
    }

    public function getOrder()
    {
        $ordres = Order::select('id', 'tracking_id')->where('batch_id', null)->get();

        // return $ordres;
        return response()->json([
            'success' => true,
            'ordres' => $ordres->toArray(),
        ], 200);
    }


    public function editCountriy()
    {
        $countries = Country::select('name', 'id')->get();
        return response()->json([
            'success' => true,
            'countries' => $countries->toArray(),
        ], 200);
    }

    //SIO1725136407
    public function getBatchLogs(Request $request)
    {
        $order = Order::where('tracking_id', $request->tarckingId)->first();
        $batch = OrderBatch::where('id', $order->batch_id)->first();
        $batch_logs = Batchlog::where('batch_id', $batch->id)->get();


        $data = [];


        $data[] = [
            [
                'country_name' => Country::where('id', $batch_logs[0]->ship_to_country_id)->first()->name,
                'city_name' => City::where('id', $batch_logs[0]->ship_to_city_id)->first()->name,
                'status' => $batch->status,
                'type' => 'Delivery'
            ],
            [
                'country_name' => Country::where('id', $batch_logs[0]->ship_from_country_id)->first()->name,
                'city_name' => City::where('id', $batch_logs[0]->ship_from_city_id)->first()->name,
                'type' => "Pickup"
            ],
        ];

        foreach ($batch_logs as $batch_log) {
            $data[][]  = [
                'country_name' => Country::where('id', $batch_log->current_location_county_id)->first()->name,
                'city_name' => City::where('id', $batch_log->current_location_city_id)->first()->name,
                'type' => "Current"
            ];
        }
        
        return response()->json([
            'success' => true,
            'logs' => $data,
        ]);
    }
}
