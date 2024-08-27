<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CurrencyExchangeRate;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CurrencyExchangeRateController extends Controller
{

    public function index()
    {   
        $countries = Country::all();
        return view('admin.currency_exchange.index',compact('countries'));
    }

    public function currencyExchangeRateList()
    {
        $items = CurrencyExchangeRate::orderBy('id','desc')->get();
        return DataTables::of($items)
            ->addIndexColumn()
            ->addColumn('name', function ($item) {
                return ($item->country->name ?? 'N/A');
            })
            ->addColumn('iso2', function ($item) {
                return (($item->country->iso2 ?? 'N/A'));
            })
            ->addColumn('exchange_rate', function ($item) {
                return $item->exchange_rate . ' ' . $item->country?->currency_symbol;
            })
            ->addColumn('action', function ($item) {

                return '<a href="javascript:void(0)" onclick="editWeightCost(' . $item->id . ')" class="btn btn-info btn-sm" ><i class="fa fa-pencil"></i> Edit Cost</a>';
            })
            ->rawColumns(['action', 'exchange_rate'])
            ->make(true);
    }

    public function updateCurrencyExchangeRate(Request $request)
    {
        try {

            $currency = CurrencyExchangeRate::where('id', $request->currency_id)->update([
                'exchange_rate' => $request->exchange_rate,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Currency exchange rate updated successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function storeCurrencyExchangeRate(Request $request)
    {
        try {
            CurrencyExchangeRate::create([
                'exchange_rate' => $request->exchange_rate,
                'country_id' => $request->country_id,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Currency exchange rate Added successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function getCurrencyExchangeRate($id)
    {
        try {
            $currency = CurrencyExchangeRate::find($id);
            return response()->json([
                'success' => true,
                'data' => $currency
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }
}
