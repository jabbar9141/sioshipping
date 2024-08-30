@extends('admin.app')
@section('page_title', 'Home')
@section('content')
    <style>
        .card {
            height: 100%;
        }

        /* Style for the card container */
        .trans {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        /* Hover effect */
        .trans:hover::before {
            opacity: 1;
        }

        .trans:hover.trans {
            transform: scale(1.08);
            /* Adjust the scale value for the zoom effect */
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Welcome, To SioShipping Managment Dashboard</h5>
                {{-- @if (Auth::user()->user_type == 'user' || optional(auth()->user()->admin)->can == 'all')
                    <div class="row">
                        <h5>User Reports</h5>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>All Orders</h6>
                                    <h4>{{ $user_rep['total_orders'] }}</h4>
                                    <a href="{{ route('orders.index') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>Unpaid Orders</h6>
                                    <h4>{{ $user_rep['total_unpaid_orders'] }}</h4>
                                    <a href="{{ route('orders.index') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>Paid Orders</h6>
                                    <h4>{{ $user_rep['totsl_paid_orders'] }}</h4>
                                    <a href="{{ route('orders.index') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>Orders in transit</h6>
                                    <h4>{{ $user_rep['total_in_transit_orders'] }}</h4>
                                    <a href="{{ route('orders.index') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>Orders delivered</h6>
                                    <h4>{{ $user_rep['total_delivered_orders'] }}</h4>
                                    <a href="{{ route('orders.index') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>Orders canceled</h6>
                                    <h4>{{ $user_rep['total_cancelled_orders'] }}</h4>
                                    <a href="{{ route('orders.index') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>All Payments</h6>
                                    <h4>{{ $user_rep['total_payments'] }}</h4>
                                    <a href="{{ route('my.payments') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>All Pending Payments</h6>
                                    <h4>{{ $user_rep['total_payments_pending'] }}</h4>
                                    <a href="{{ route('my.payments') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>All Failed Payments</h6>
                                    <h4>{{ $user_rep['total_payments_failed'] }}</h4>
                                    <a href="{{ route('my.payments') }}">See All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card trans">
                                <div class="card-body">
                                    <h6>Total Paid(&euro;)</h6>
                                    <h4>{{ number_format($user_rep['total_payments_value'], 2) }}</h4>
                                    <a href="{{ route('my.payments') }}">See All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif --}}
                {{-- @if (Auth::user()->user_type == 'dispatcher' || optional(auth()->user()->admin)->can == 'all')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dispatch-actions-tab" data-bs-toggle="tab"
                                data-bs-target="#dispatch-actions-tab-pane" type="button" role="tab"
                                aria-controls="dispatch-actions-tab-pane" aria-selected="true">Agent Actions</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dispatch-reports-tab" data-bs-toggle="tab"
                                data-bs-target="#dispatch-reports-tab-pane" type="button" role="tab"
                                aria-controls="dispatch-reports-tab-pane" aria-selected="false">Agent Reports</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dispatch-actions-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="row mt-2">
                                <div class="col-sm-2">
                                    <div class="card trans" href="{{ route('walk_in_customer_order.create') }}">
                                        <img src="{{ asset('admin_assets/assets/images/ship-boat.jpg') }}"
                                            class="card-img-top" alt="Shipping">
                                        <div class="card-body">
                                            <h5 class="card-title">Shipping</h5>
                                            <a href="{{ route('walk_in_customer_order.create') }}">Create Order</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="card trans">
                                        <img src="{{ asset('admin_assets/assets/images/transfer.png') }}"
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">EU Funds</h5>
                                            <a href="{{ route('eu_fund_trasfer_order.index') }}">Create Order</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="card trans">
                                        <img src="{{ asset('admin_assets/assets/images/international.jpg') }}"
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Intl. Funds</h5>
                                            <a href="{{ route('intl_fund_trasfer_order.index') }}">Create Order</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dispatch-reports-tab-pane" role="tabpanel"
                            aria-labelledby="profile-tab" tabindex="0">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="card trans">
                                        <div class="card-body">
                                            <h6>Total Orders Accepted</h6>
                                            <h4>{{ $dispatcher_rep['total_orders'] }}</h4>
                                            <a href="{{ route('dispatchOrders') }}">See All</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="card trans">
                                        <div class="card-body">
                                            <h6>Total Orders Accepted [In Transit]</h6>
                                            <h4>{{ $dispatcher_rep['total_in_transit_orders'] }}</h4>
                                            <a href="{{ route('dispatchOrders') }}">See All</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="card trans">
                                        <div class="card-body">
                                            <h6>Total Orders Accepted [Delivered]</h6>
                                            <h4>{{ $dispatcher_rep['total_delivered_orders'] }}</h4>
                                            <a href="{{ route('dispatchOrders') }}">See All</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="card trans">
                                        <div class="card-body">
                                            <h6>Total Orders Accepted [Picked-Up]</h6>
                                            <h4>{{ $dispatcher_rep['total_picked_up_orders'] }}</h4>
                                            <a href="{{ route('dispatchOrders') }}">See All</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="card trans">
                                        <div class="card-body">
                                            <h6>Total Orders Accepted [Canceled]</h6>
                                            <h4>{{ $dispatcher_rep['total_cancelled_orders'] }}</h4>
                                            <a href="{{ route('dispatchOrders') }}">See All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif --}}

                @if (Auth::user()->user_type == 'admin')
                    {{-- <div class="row">
                        <div class="col-sm-2">
                            <div class="card " href="">
                                <img src="{{ asset('admin_assets/assets/images/user_icon.jpg') }}" class="card-img-top"
                                    alt="Shipping">
                                <div class="card-body">
                                    <h5 class="card-title text-nowrap">Total Users : {{ $totalUsers }}</h5>
                                    <a href="{{ route('allUsers') }}">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card" href="">
                                <img src="{{ asset('admin_assets/assets/images/kyc.jpg') }}" class="card-img-top"
                                    alt="Shipping">
                                <div class="card-body">
                                    <h5 class="card-title">KYC</h5>
                                    <a href="{{ route('walk_in_customers.index') }}">Manage</a>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-sm-2">
                            <div class="card trans" href="">
                                <img src="{{ asset('admin_assets/assets/images/ship-boat.jpg') }}" class="card-img-top"
                                    alt="Shipping">
                                <div class="card-body">
                                    <h5 class="card-title">Shipping</h5>
                                    <a href="{{ route('allOrders') }}">Manage</a>
                                </div>
                            </div>
                        </div>

                    </div> --}}


                    {{-- <ul class="nav nav-tabs" id="adminTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="admin-actions-tab" data-bs-toggle="tab"
                                data-bs-target="#admin-actions-tab-pane" type="button" role="tab"
                                aria-controls="admin-actions-tab-pane" aria-selected="true">Admin Actions</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="admin-reports-tab" data-bs-toggle="tab"
                                data-bs-target="#admin-reports-tab-pane" type="button" role="tab"
                                aria-controls="admin-reports-tab-pane" aria-selected="false">Admin Reports</button>
                        </li>
                    </ul> --}}
                    <div class="tab-content" id="adminTabContent">
                        <div class="tab-pane fade show active" id="admin-actions-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">

                        </div>
                        {{-- <div class="tab-pane fade" id="admin-reports-tab-pane" role="tabpanel"
                            aria-labelledby="profile-tab" tabindex="0">
                            <div class="row">
                                @if (optional(auth()->user()->admin)->can == 'all' || optional(auth()->user()->admin)->can == 'kyc')
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Total Users</h6>
                                                <h4>{{ $admin_rep['total_users'] }}</h4>
                                                <a href="{{ route('allUsers') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Total Users [Blocked]</h6>
                                                <h4>{{ $admin_rep['total_blocked_users'] }}</h4>
                                                <a href="{{ route('allUsers') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Total Walk In Customers</h6>
                                                <h4>{{ $admin_rep['total_customers'] }}</h4>
                                                <a href="{{ route('walk_in_customers.index') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Total Walk In Customers [KYC Approved]</h6>
                                                <h4>{{ $admin_rep['total_approved_users'] }}</h4>
                                                <a href="{{ route('walk_in_customers.index') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (optional(auth()->user()->admin)->can == 'all' || optional(auth()->user()->admin)->can == 'accounts')
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Orders</h6>
                                                <h4>{{ $admin_rep['total_orders'] }}</h4>
                                                <a href="{{ route('allOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Unpaid Orders</h6>
                                                <h4>{{ $admin_rep['total_unpaid_orders'] }}</h4>
                                                <a href="{{ route('allOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Paid Orders</h6>
                                                <h4>{{ $admin_rep['totsl_paid_orders'] }}</h4>
                                                <a href="{{ route('allOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Orders in transit</h6>
                                                <h4>{{ $admin_rep['total_in_transit_orders'] }}</h4>
                                                <a href="{{ route('allOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Orders delivered</h6>
                                                <h4>{{ $admin_rep['total_delivered_orders'] }}</h4>
                                                <a href="{{ route('allOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Orders delivered</h6>
                                                <h4>{{ $admin_rep['total_picked_up_orders'] }}</h4>
                                                <a href="{{ route('allOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Orders canceled</h6>
                                                <h4>{{ $admin_rep['total_cancelled_orders'] }}</h4>
                                                <a href="{{ route('allOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Payments</h6>
                                                <h4>{{ $admin_rep['total_payments'] }}</h4>
                                                <a href="{{ route('all.payments') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Pending Payments</h6>
                                                <h4>{{ $admin_rep['total_payments_pending'] }}</h4>
                                                <a href="{{ route('all.payments') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Failed Payments</h6>
                                                <h4>{{ $admin_rep['total_payments_failed'] }}</h4>
                                                <a href="{{ route('all.payments') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Total Paid For shipping(&euro;)</h6>
                                                <h4>{{ number_format($admin_rep['total_payments_value'], 2) }}</h4>
                                                <a href="{{ route('all.payments') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Total Paid EU Fund Transfers(&euro;)</h6>
                                                <h4>{{ number_format($admin_rep['total_eu_funds_value'], 2) }}</h4>
                                                <a href="{{ route('adminEUFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All EU Fund Transfers</h6>
                                                <h4>{{ $admin_rep['total_eu_funds'] }}</h4>
                                                <a href="{{ route('adminEUFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Completed EU Fund Transfers</h6>
                                                <h4>{{ $admin_rep['total_eu_funds_done'] }}</h4>
                                                <a href="{{ route('adminEUFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Rejected EU Fund Transfers</h6>
                                                <h4>{{ $admin_rep['total_eu_funds_rejected'] }}</h4>
                                                <a href="{{ route('adminEUFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>Total Paid Intl. Fund Transfers(&euro;)</h6>
                                                <h4>{{ number_format($admin_rep['total_intl_funds_value'], 2) }}</h4>
                                                <a href="{{ route('adminIntlFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Intl. Fund Transfers</h6>
                                                <h4>{{ $admin_rep['total_eu_funds'] }}</h4>
                                                <a href="{{ route('adminIntlFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Completed Intl. Fund Transfers</h6>
                                                <h4>{{ $admin_rep['total_intl_funds_done'] }}</h4>
                                                <a href="{{ route('adminIntlFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card trans">
                                            <div class="card-body">
                                                <h6>All Rejected Intl. Fund Transfers</h6>
                                                <h4>{{ $admin_rep['total_intl_funds_rejected'] }}</h4>
                                                <a href="{{ route('adminIntlFundOrders') }}">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div> --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
