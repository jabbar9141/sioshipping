<?php

namespace App\Http\Controllers;

use App\Mail\PaymentEmail;
use App\Models\Agent;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public static function canDispatch()
    {
        // dd(request()->user());
        if (Auth::user() && Auth::user()->user_type != 'admin' && Auth::user()->user_type != 'agent') {
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
        $agent = Auth::user();
        return view('agents.settings.edit', compact('agent'));
    }

    /**
     * hompage for the accepting orders
     */

    public function accept()
    {
        return view('agents.accept');
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
            return view('agents.accept')->with(['order' => $o]);
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
    public function create() {}

    public function createDispatcher() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispatcher  $dispatcher
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $dispatcher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $dispatcher
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        $agent = Agent::find($agent->id);
        return view('agents.settings.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispatcher  $dispatcher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'phone_alt' => 'nullable|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'zip' => 'required',
            'residential_country' => 'required',
            'residential_state' => 'required',
            'residential_city' => 'required',
            'agency_type' => 'required',
            'tax_id_code' => 'required',
        ]);
        try {
            $agent = Agent::find($agent->id);
            $destinationDirectory = public_path('uploads/documents');
            if (!file_exists($destinationDirectory)) {
                mkdir($destinationDirectory, 0755, true);
            }
            
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $filename = rand(100000, 999999) . '.' . $attachment->extension();
                $attachment->move($destinationDirectory, $filename);

                if ($agent->attachment_path) {
                    $oldAttachmentPath = public_path($agent->attachment_path);
                    if (file_exists($oldAttachmentPath)) {
                        unlink($oldAttachmentPath);
                    }
                }
                
                $agent->update([
                    'attachment_path' => 'uploads/documents'.$filename,
                ]);
            }
            if ($request->hasFile('attachment')) {
                $front_attachment = $request->file('front_attachment');
                $front_filename = rand(100000, 999999) . '_front.' . $front_attachment->extension();
                $front_attachment->move($destinationDirectory, $front_filename);

                if ($agent->front_attachment) {
                    $oldFrontAttachmentPath = public_path($agent->front_attachment);
                    if (file_exists($oldFrontAttachmentPath)) {
                        unlink($oldFrontAttachmentPath);
                    }
                }
                $agent->update([
                    'front_attachment' => 'uploads/documents'.$front_filename,
                ]);
            }
            $agent->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'phone_alt' => $request->phone_alt,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'zip' => $request->zip,
                'city' => City::find($request->residential_city)->name ?? '',
                'state' => State::find($request->residential_state)->name ?? '',
                'country' => Country::find($request->residential_country)->name ?? '',
                'agency_type' => $request->agency_type ?? '',
                'business_name' => $request->business_name ?? '',
                'tax_id_code' => $request->tax_id_code ?? '',
                'vat_no' => $request->vat_no ?? '',
                'pec' => $request->pec ?? '',
                'sdi' => $request->sdi ?? '',
                'city_id' => $request->residential_city ?? '',
                'state_id' => $request->residential_state ?? '',
                'country_id' => $request->residential_country ?? ''
            ]);
            return back()->with(['message' => 'Record Updated Successfully!', 'message_type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->with('message', "An error occured " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agnet  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
