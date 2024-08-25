<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;
use App\Models\OrderBatch;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

use App\Mail\PaymentEmail;
use Illuminate\Support\Facades\Mail;

class OrderBatchController extends Controller
{
    public function __construct()
    {
        DispatcherController::canDispatch();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dispatcher.settings.batches.index');
    }

    /**
     * ajax function for locationList
     */
    public function batchList()
    {
        $d = Auth::user()->dispatcher->id;
        $batch = OrderBatch::where('dispatcher_id', $d)->orderBy('created_at', 'DESC')->get();

        return Datatables::of($batch)
            ->addIndexColumn()
            ->addColumn('status', function ($orderBatch) {
                $mar = "<span class= 'badge bg-secondary'>" . $orderBatch->status . "</span>";
                return $mar;
            })
            ->addColumn('location', function ($orderBatch) {
                $mar = "Cur. Loc. : " . $orderBatch->location->name;
                return $mar;
            })
            ->addColumn('edit', function ($orderBatch) {
                $edit_url = route('batches.edit', $orderBatch->id);
                return '<a href="' . $edit_url . '" class="btn btn-info btn-sm" ><i class="fa fa-pencil"></i> Edit</a>';
            })
            ->addColumn('view', function ($orderBatch) {
                $url = route('batches.show', $orderBatch->id);
                return '<a href="' . $url . '" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i> View</a>';
            })
            // ->addColumn('delete', function ($loaction) {
            //     $url = route('locations.destroy', $loaction->id);
            //     return '<form method="POST" action="' . $url . '">
            //                 <input type="hidden" name = "_token" value = ' . csrf_token() . '>
            //                 <input type="hidden" name = "_method" value ="DELETE">
            //                 <button type="submit" onclick="return confirm(\'Are you sure you wish to delete this entry?\')" class="btn btn-sm btn-danger">Delete</button>
            //             </form>';
            // })
            ->rawColumns(['edit', 'view', 'location', 'status'])
            ->make(true);
    }

    /**
     * datatable for cutomer orders
     */
    public function batchOrdersList($batch_id)
    {
        $orders = Order::where('batch_id', $batch_id)->orderBy('created_at', 'DESC')->get();

        return Datatables::of($orders)
            ->addIndexColumn()
            ->addColumn('status', function ($order) {
                $mar = "<span class= 'badge bg-secondary'>" . $order->status . "</span>";
                return $mar;
            })
            ->addColumn('location', function ($order) {
                $mar = "Origin : " . $order->pickup_location->name . "<br>";
                $mar .= "Destination:" . $order->delivery_location->name;
                return $mar;
            })
            ->addColumn('date', function ($order) {
                $mar = "<b> Tracking ID : " . $order->tracking_id . "</b><br><br>";
                $mar .= "Created at : " . $order->created_at . "<br>";
                $mar .= "Last updated:" . $order->updated_at;
                return $mar;
            })
            ->addColumn('parties', function ($order) {
                $mar = "Sender : " . $order->pickup_name . "<br>";
                $mar .= "Receiver:" . $order->delivery_name;
                return $mar;
            })
            ->addColumn('edit', function ($order) {
                $edit_url = route('batchOrderEdit', $order->id);
                return '<a href="' . $edit_url . '" class="btn btn-info btn-sm" ><i class="fa fa-pencil"></i> Edit</a>';
            })
            ->addColumn('price', function ($order) {
                $mar = $order->shipping_rate->price . "<br>";
                return $mar;
            })
            ->addColumn('view', function ($order) {
                $url = route('orders.show', [$order->id, 'mode' => '0']);
                return '<a href="' . $url . '" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i> View/ Track</a>';
            })
            // ->addColumn('delete', function ($order) {
            //     $url = route('shipping_rates.destroy', $order->id);
            //     return '<form method="POST" action="' . $url . '">
            //                 <input type="hidden" name = "_token" value = ' . csrf_token() . '>
            //                 <input type="hidden" name = "_method" value ="DELETE">
            //                 <button type="submit" onclick="return confirm(\'Are you sure you wish to delete this entry?\')" class="btn btn-sm btn-danger">Delete</button>
            //             </form>';
            // })
            ->rawColumns(['status', 'location', 'edit', 'view', 'parties', 'date', 'price'])
            ->make(true);
    }

    /**
     * ajax search
     */
    public function search(Request $request)
    {
        $query = $request->get('term', '');

        $d = Auth::user()->dispatcher->id;

        $batches = OrderBatch::where('dispatcher_id', $d)->where('name', 'LIKE', '%' . $query . '%')
            ->select('id', 'name')
            ->get();

        $results = [];

        foreach ($batches as $batch) {
            $results[] = [
                'label' => $batch->name,
                'value' => $batch->id,
            ];
        }
        return response()->json($results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dispatcher.settings.batches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'origin_id' => 'required|numeric|exists:locations,id'
        ]);
        try {
            $b = OrderBatch::create([
                'name' => 'BA-' . time() . '-' . $request->name,
                'location_id' => $request->origin_id,
                'dispatcher_id' => Auth::user()->dispatcher->id
            ]);
            return back()->with(['message' => 'Batch Created', 'message_type' => 'success']);
        } catch (\Exception $e) {
            // DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->with('message', "An error occured " . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderBatch  $orderBatch
     * @return \Illuminate\Http\Response
     */
    public function show($orderBatch)
    {
        $batch = OrderBatch::where('id', $orderBatch)->first();
        return view('dispatcher.settings.batches.show', ['batch' => $batch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderBatch  $orderBatch
     * @return \Illuminate\Http\Response
     */
    public function edit($orderBatch)
    {
        $orderBatch = OrderBatch::where('id', $orderBatch)->first();
        $loc_str = $orderBatch->location->postcode . '-' . $orderBatch->location->name . ' [Lat: ' . $orderBatch->location->latitude . ', Long: ' . $orderBatch->location->longitude . ']';
        return view('dispatcher.settings.batches.edit', ['batch' => $orderBatch, 'loc_str' => $loc_str]);
    }

    /**
     * modify an order
     */
    public function batchOrderEdit(Request $request, $order_id)
    {
        // dd($request->all());
        if ($request->method() == 'POST') {
            $request->validate([
                'batch_id' => 'required|numeric|exists:order_batches,id',
                'status' => 'required|string',
                'current_location_id' => 'required|numeric|exists:locations,id'
            ]);
            try {
                $o = Order::where('id', $order_id)->update([
                    'status' => $request->status,
                    'batch_id' => $request->batch_id,
                    'current_location_id' => $request->current_location_id
                ]);
                return back()->with(['message' => 'Order Updated', 'message_type' => 'success']);
            } catch (\Exception $e) {
                Log::error($e->getMessage(), ['exception' => $e]);
                return back()->with('message', "An error occured " . $e->getMessage());
            }
        } else {
            $o = Order::where('id', $order_id)->first();
            $loc_str = $o->current_location->postcode . '-' . $o->current_location->name . ' [Lat: ' . $o->current_location->latitude . ', Long: ' . $o->current_location->longitude . ']';
            return view('dispatcher.settings.orders.edit', ['order' => $o, 'loc_str' => $loc_str]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderBatch  $orderBatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderBatch)
    {
        $request->validate([
            'origin_id' => 'required|numeric|exists:locations,id',
            'status' => 'required|string'
        ]);
        try {
            $orderBatch = OrderBatch::where('id', $orderBatch)->first();
            DB::beginTransaction();
            $b = $orderBatch->update([
                'location_id' => $request->origin_id,
                'status' => $request->status
            ]);
            //update status of associated orders
            Order::where('batch_id', $orderBatch->id)->update([
                'status' => $request->status,
                'current_location_id' => $request->origin_id
            ]);

            $oo = Order::where('batch_id', $orderBatch->id)->get();
            foreach ($oo as $o) {
                Mail::to($o->customer->user->email)->send(new PaymentEmail($o));

                Mail::to($o->pickup_email)->send(new PaymentEmail($o));

                Mail::to($o->delivery_email)->send(new PaymentEmail($o));
            }

            DB::commit();
            return back()->with(['message' => 'Batch Updated', 'message_type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->with('message', "An error occured " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderBatch  $orderBatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderBatch $orderBatch)
    {
        //
    }
}
