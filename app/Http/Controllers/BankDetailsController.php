<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use App\Models\Country;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $bank_details = BankDetail::get();
            return DataTables::of($bank_details)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $buttons = '';
                    $buttons .= '<div class="d-flex">
                    <a class="btn btn-primary mx-5" href="' . route('bank_details.edit', $row->id) . '"><i class="fa fa-pencil"></i>Edit</a> 
                    <form style="" action="' . route('bank_details.destroy', $row->id) . '" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-danger mx-5">Delete</button>
                    </form>
                    </div>';
                    return $buttons;
                })
                ->addColumn('country_id', function ($row) {
                    $ctry = $row->country->name;
                    return $ctry;
                })
                ->addColumn('city_id', function ($row) {
                    $ctry = $row->city->name;
                    return $ctry;
                })
                ->rawColumns(['action', 'country_id', 'city_id'])
                ->make(true);
        }

        return view('agents.bankdetails.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agents.bankdetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'bank_name' => 'required',
            'iban' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
        ]);
        // dd($request->all());
        if ($validate) {
            BankDetail::create([
                'bank_name' => $request->bank_name,
                'iban' => $request->iban,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'status' => 'active'
            ]);

            return redirect()->route('bank_details.index')->with('success', 'Add Successfully');
        } else {
            return redirect()->route('bank_details.create')->with('Failed to Add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank_detail = BankDetail::find($id);
        $selected_city = $bank_detail->city_id;
        $selected_country = $bank_detail->country_id;
        $data = [
            'bank_detail' => BankDetail::find($id),
            'selected_city' => $selected_city,
            'selected_country' => $selected_country
        ];

        return view('agents.bankdetails.update', $data);
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
        $validate = $request->validate([
            'bank_name' => 'required',
            'iban' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
        ]);
        // dd($request->all());
        if ($validate) {
            $bank_detail = BankDetail::find($id);
            $bank_detail->bank_name = $request->bank_name;
            $bank_detail->iban = $request->iban;
            $bank_detail->country_id = $request->country_id;
            $bank_detail->city_id = $request->city_id;;
            $bank_detail->status = 'active';
            return redirect()->route('bank_details.index')->with('success', 'Add Successfully');
        } else {
            return redirect()->route('bank_details.create')->with('Failed to Add');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank_detail = BankDetail::find($id);
        $bank_detail->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }
}
