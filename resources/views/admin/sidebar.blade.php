<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img">
                <img src="{{ asset('landing/assets/img/gallery/sioshipping_logo.png') }}" height="45" alt="logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <li class="sidebar-item">
                    <a class="sidebar-link @if (Route::is('home*')) active @endif" href="{{ route('home') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                {{-- @if (Auth::user()->user_type == 'agent')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <h2 class="hide-menu">POS: {{ str_pad(Auth::id(), 4, '0', STR_PAD_LEFT) }}</h2>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <h6 class="hide-menu">Today's Commision (&euro;) :
                            {{ getAccountbalances(Auth::id())['earningsToday'] }}</h6>
                        <h6 class="hide-menu">Today's Spendings (&euro;) :
                            {{ getAccountbalances(Auth::id())['spentToday'] }}</h6>
                        <h6 class="hide-menu">Account Balance (&euro;) : {{ getAccountbalances(Auth::id())['balance'] }}
                        </h6>
                    </li>
                @endif --}}

                @if (Auth::user()->user_type == 'agent')
                    <li class="sidebar-item">
                        <a class="sidebar-link  @if (Route::is('my-wallet.*')) active @endif"
                            href="{{ route('my-wallet.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa-solid fa-gears"></i>
                            </span>
                            <span class="hide-menu">May Wallet</span>
                        </a>
                    </li>
                   
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (Route::is('agentsOrders') || Route::is('walkInOrderAgents.*') ) active @endif" href="{{ route('agentsOrders') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">All orders</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">New Shipping Order</span>
                        </a>
                    </li> --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (Route::is('agent.accept') || Route::is('agent.accept.search')) active @endif" href="{{ route('agent.accept') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Accept/Pick-Up Order</span>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->user_type == 'admin')
                    {{-- @if (Auth::user()->user_type == 'admin' && (optional(auth()->user()->admin)->can == 'all' || optional(auth()->user()->admin)->can == 'kyc')) --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (Route::is('allUsers') || Route::is('create.dispatcher') || Route::is('dispatchers.*')) active @endif"
                            href="{{ route('allUsers') }}" aria-expanded="false">
                            <span>
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <span class="hide-menu">Manage Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (Route::is('cities.shipping.rates') || Route::is('shipping_rates.index') || Route::is('weight.shipping.rates')) active @endif"
                            href="{{ route('shipping_rates.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa-solid fa-ferry"></i>
                            </span>
                            <span class="hide-menu">Shippings Cost</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (Route::is('currency-view')) active @endif"
                            href="{{ route('currency-view') }}" aria-expanded="false">
                            <span>
                                <i class="fa-solid fa-coins"></i>
                            </span>
                            <span class="hide-menu">Currency Exchange</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (Route::is('bank_details.*')) active @endif"
                            href="{{ route('bank_details.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa-solid fa-coins"></i>
                            </span>
                            <span class="hide-menu">Bank Details</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link  @if (Route::is('batches.*')) active @endif"
                            href="{{ route('batches.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Batches</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('walk_in_customers.index') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <span class="hide-menu">Manage KYC</span>
                            </a>
                        </li> --}}
                    {{-- @endif --}}
                    {{-- @if (Auth::user()->user_type == 'admin' && (optional(auth()->user()->admin)->can == 'all' || optional(auth()->user()->admin)->can == 'accounts')) --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (Route::is('allOrders') || Route::is('orders.*')) active @endif"
                            href="{{ route('allOrders') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">All Orders</span>
                        </a>
                    </li>
                    {{-- @endif --}}

                    {{-- @if (Auth::user()->user_type == 'admin' && optional(auth()->user()->admin)->can == 'all') --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link  @if (Route::is('products.*')) active @endif"
                            href="{{ route('products.index') }}" aria-expanded="false">
                            <span>
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="hide-menu">Global Products</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.settings') }}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-gears"></i>
                                </span>
                                <span class="hide-menu">Settings</span>
                            </a>
                        </li> --}}
                    {{-- @endif --}}
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
