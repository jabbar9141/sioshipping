<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Mail\PaymentEmail;
use Illuminate\Support\Facades\Mail;

class DispatcherController extends Controller
{
    public static function canDispatch()
    {
        // dd(request()->user());
        if (Auth::user() && Auth::user()->user_type != 'admin' && Auth::user()->user_type != 'dispatcher') {
            return abort(402, 'You do not have access to this functionality');
        }
    }
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
     * hompage for the various dispatcher settings
     */

    public function settings()
    {
        return view('dispatcher.settings.index');
    }

    /**
     * hompage for the accepting orders
     */

    public function accept()
    {
        return view('dispatcher.accept');
    }

    /**
     * hompage for the accepting orders
     */

    public function accept_search(Request $request)
    {
        $request->validate([
            'order_track_id' => 'required|exists:orders,tracking_id'
        ]);

        $o = Order::where('tracking_id', $request->order_track_id)->first();
        if ($o) {
            return view('dispatcher.accept')->with(['order' => $o]);
        } else {
            return back()->with('message', 'Order not Found');
        }
    }

    /**
     * dispatcher accpt order
     */
    public function orderAccept(Request $request, $order_id)
    {
        $request->validate([
            'batch_id' => 'required|numeric|exists:order_batches,id'
        ]);

        try {

            $o = Order::where('id', $order_id)->first();
            $p = $o->shipping_rate->price;
            if (getAccountbalances(Auth::id())['balance'] >= $p) {
                Order::where('id', $order_id)->update([
                    'status' => 'assigned',
                    'batch_id' => $request->batch_id,
                    'dispatcher_id' => Auth::user()->dispatcher->id,
                    'pickup_time' => Carbon::now(),
                ]);

                $u = updateAccountBalance(Auth::id(), ($p), $o->tracking_id, 'credit', 'Order ' . $o->tracking_id);
                $c = updateAccountBalance(Auth::id(), ($p * 0.015), $o->tracking_id, 'debit', 'Order Commision ' . $o->tracking_id);

                if ($o->customer) {
                    Mail::to($o->customer->user->email)->send(new PaymentEmail($o));
                }

                Mail::to($o->pickup_email)->send(new PaymentEmail($o));

                Mail::to($o->delivery_email)->send(new PaymentEmail($o));

                return back()->with(['message' => 'Order Accepted and Batch Assigned', 'message_type' => 'success']);
            } else {
                return back()->with(['message' => 'Insufficent Balance to complete Order']);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->with('message', "An error occured " . $e->getMessage());
        }
    }

    /**
     * dispatcher accpt order
     */
    public function orderPickedUp(Request $request, $order_id)
    {
        try {
            $o = Order::where('id', $order_id)->first();

            Order::where('id', $order_id)->update([
                'status' => 'picked_up',
                'delivery_time' => Carbon::now(),
                'current_location_id' => $o->delivery_location_id
            ]);

            return back()->with(['message' => 'Order Marked As Picked Up', 'message_type' => 'success']);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->with('message', "An error occured " . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            //check if the user has a dispatcher profile
            $d = Dispatcher::where('user_id', Auth::id())->first();
            if ($d) {
                return view('dispatcher.settings.profile', ['dispatcher' => $d]);
            } else {
                $d = Dispatcher::create([
                    'user_id' => Auth::id(),
                    'name' => Auth::user()->name
                ]);
                return view('dispatcher.settings.profile', ['dispatcher' => $d]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->with('message', "An error occured " . $e->getMessage());
        }
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
     * @param  \App\Models\Dispatcher  $dispatcher
     * @return \Illuminate\Http\Response
     */
    public function show(Dispatcher $dispatcher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispatcher  $dispatcher
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispatcher $dispatcher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispatcher  $dispatcher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dispatcher $dispatcher)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'phone_alt' => 'nullable|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'zip' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'agency_type' => 'required',
            'tax_id_code' => 'required',
        ]);
        try {
            $dispatcher->name = $request->name;
            $dispatcher->phone = $request->phone;
            $dispatcher->phone_alt = $request->phone_alt;
            $dispatcher->address1 = $request->address1;
            $dispatcher->address2 = $request->address2;
            $dispatcher->zip = $request->zip;
            $dispatcher->city = $request->city;
            $dispatcher->state = $request->state;
            $dispatcher->country = $request->country;
            $dispatcher->agency_type = $request->agency_type;
            $dispatcher->tax_id_code = $request->tax_id_code;
            $dispatcher->vat_no = $request->vat_no;
            $dispatcher->pec = $request->pec;
            $dispatcher->sdi = $request->sdi;
            $dispatcher->business_name = $request->business_name;
            $dispatcher->update();
            return back()->with(['message' => 'Profile Updated', 'message_type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->with('message', "An error occured " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispatcher  $dispatcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispatcher $dispatcher)
    {
        //
    }
}
