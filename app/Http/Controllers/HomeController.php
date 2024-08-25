<?php

namespace App\Http\Controllers;

use App\Models\EUFundsTransferRates;
use App\Models\EUFundTransferOrder;
use App\Models\IntlFundsTransferRates;
use App\Models\IntlFundTransferOrder;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\WalkInCustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['landing', 'trackShipping']);
        // dd(App::currentLocale());
    }

    public function adminReports()
    {
        $rep = [];
        $rep['total_users'] = User::count();
        $rep['total_blocked_users'] = User::where('blocked', true)->count();

        $rep['total_customers'] = WalkInCustomer::count();
        $rep['total_approved_users'] = WalkInCustomer::where('kyc_status', 'approved')->count();

        $rep['total_orders'] = Order::count();
        $rep['total_unpaid_orders'] = Order::where('status', 'unpaid')->count();
        $rep['totsl_paid_orders'] = Order::where('status', '!=', 'unpaid')->count();
        $rep['total_in_transit_orders'] = Order::where('status', 'in_transit')->count();
        $rep['total_delivered_orders'] = Order::where('status', 'delivered')->count();
        $rep['total_cancelled_orders'] = Order::where('status', 'cancelled')->count();
        $rep['total_picked_up_orders'] = Order::where('status', 'picked_up')->count();

        $rep['total_payments'] = Payment::where('status', 'done')->count();
        $rep['total_payments_pending'] = Payment::where('status', 'pending')->count();
        $rep['total_payments_failed'] = Payment::where('status', 'failed')->count();
        $rep['total_payments_value'] = Payment::where('status', 'done')->sum('amt_paid');

        $rep['total_eu_funds'] = EUFundTransferOrder::count();
        $rep['total_eu_funds_done'] = EUFundTransferOrder::where('tx_status', 'done')->count();
        $rep['total_eu_funds_rejected'] = EUFundTransferOrder::where('tx_status', 'rejected')->count();
        $rep['total_eu_funds_value'] = EUFundTransferOrder::where('tx_status', 'done')->sum('s_amount');

        $rep['total_intl_funds'] = IntlFundTransferOrder::count();
        $rep['total_intl_funds_done'] = IntlFundTransferOrder::where('tx_status', 'done')->count();
        $rep['total_intl_funds_rejected'] = IntlFundTransferOrder::where('tx_status', 'rejected')->count();
        $rep['total_intl_funds_value'] = IntlFundTransferOrder::where('tx_status', 'done')->sum('s_amount');

        return $rep;
    }

    public function customerReports()
    {
        $rep = [];
        $rep['total_orders'] = Order::where('customer_id', Auth::user()->customer->id)->count();
        $rep['total_unpaid_orders'] = Order::where('status', 'unpaid')->where('customer_id', Auth::user()->customer->id)->count();
        $rep['totsl_paid_orders'] = Order::where('status', '!=', 'unpaid')->where('customer_id', Auth::user()->customer->id)->count();
        $rep['total_in_transit_orders'] = Order::where('status', 'in_transit')->where('customer_id', Auth::user()->customer->id)->count();
        $rep['total_delivered_orders'] = Order::where('status', 'delivered')->where('customer_id', Auth::user()->customer->id)->count();
        $rep['total_cancelled_orders'] = Order::where('status', 'cancelled')->where('customer_id', Auth::user()->customer->id)->count();

        $rep['total_payments'] = Payment::where('status', 'done')->where('customer_id', Auth::user()->customer->id)->count();
        $rep['total_payments_pending'] = Payment::where('status', 'pending')->where('customer_id', Auth::user()->customer->id)->count();
        $rep['total_payments_failed'] = Payment::where('status', 'failed')->where('customer_id', Auth::user()->customer->id)->count();
        $rep['total_payments_value'] = Payment::where('status', 'done')->where('customer_id', Auth::user()->customer->id)->sum('amt_paid');

        return $rep;
    }

    public function dispatchReports()
    {
        $rep = [];
        $rep['total_orders'] = Order::where('dispatcher_id', Auth::user()->dispatcher->id)->count();
        $rep['total_in_transit_orders'] = Order::where('status', 'in_transit')->where('dispatcher_id', Auth::user()->dispatcher->id)->count();
        $rep['total_delivered_orders'] = Order::where('status', 'delivered')->where('dispatcher_id', Auth::user()->dispatcher->id)->count();
        $rep['total_cancelled_orders'] = Order::where('status', 'cancelled')->where('dispatcher_id', Auth::user()->dispatcher->id)->count();
        $rep['total_picked_up_orders'] = Order::where('status', 'picked_up')->where('dispatcher_id', Auth::user()->dispatcher->id)->count();

        $orders_arr = (array) Order::where('dispatcher_id', Auth::user()->dispatcher->id)->get('id');

        return $rep;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin_rep = [];
        $dispatcher_rep = [];
        $user_rep = [];
        if (Auth::user()->user_type == 'admin') {
            $admin_rep = $this->adminReports();
            $dispatcher_rep = $this->dispatchReports();
            $user_rep = $this->customerReports();
        } else if (Auth::user()->user_type == 'dispatcher') {
            $dispatcher_rep = $this->dispatchReports();
            $user_rep = $this->customerReports();
        } else {
            $user_rep = $this->customerReports();
        }
        return view('home', ['admin_rep' => $admin_rep, 'dispatcher_rep' => $dispatcher_rep, 'user_rep' => $user_rep]);
    }

    public function landing(Request $request)
    {    
        $p = Product::limit(10)->get();
        if (!empty($request->s_country_eu) && !empty($request->rx_country_eu)) {
            $rate = EUFundsTransferRates::where('s_country_eu', $request->s_country_eu)
                ->where('rx_country_eu', $request->rx_country_eu)
                ->where('min_amt', '<=', $request->rx_amount_eu)
                ->where('max_amt', '>=', $request->rx_amount_eu)
                ->where('status', 1)->first();

            return view('welcome', ['eu_rate' => $rate]);
        } else if (!empty($request->s_country) && !empty($request->rx_country)) {
            $rate = IntlFundsTransferRates::where('s_country', $request->s_country)
                ->where('rx_country', $request->rx_country)
                ->where('min_amt', '<=', $request->rx_amount)
                ->where('max_amt', '>=', $request->rx_amount)
                ->where('status', 1)->first();


            return view('welcome', ['global_rate' => $rate, 'products' => $p]);
        } else {
            return view('welcome', ['products' => $p]);
        }
    }

    public function trackShipping($tracking_id)
    {
        $r = Order::where('tracking_id', $tracking_id)->first();
        return view('shiping-track', ['order' => $r]);
    }
}
