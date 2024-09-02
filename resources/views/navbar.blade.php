<!-- Topbar Start -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg">
    <div class="md:px-44 w-full p-2 flex justify-between items-center">
        <div>
            <a class="navbar-brand" href="/">
                <img src="{{ asset('landing/assets/img/gallery/sioshipping_logo.png') }}" height="5" class="h-10 w-20"
                    alt="logo">
            </a>
        </div>

        <!-- Mobile Menu Toggler -->
        <button class="navbar-toggler lg:hidden text-gray-500 focus:outline-none focus:border-none" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6h16.5m-16.5 6h16.5m-16.5 6h16.5" />
            </svg>
        </button>

        <div class="lg:flex space-x-3 items-center hidden">
            <a href="/">{{ trans('nav.1') }} </a>
            <a class="" href="{{ route('who_we_are') }}">{{ trans('nav.2') }}</a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ trans('nav.3') }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('shipping_page') }}">{{ trans('hompage.42') }}</a>
                    <a class="dropdown-item" href="{{ route('pick_up_point_page') }}">{{ trans('hompage.46') }}</a>
                    <a class="dropdown-item" href="{{ route('showcase') }}">Agro Procuct Trade</a>

                    <a class="dropdown-item" href="{{ route('shipping_page') }}">Food Packaging and storage</a>
                </ul>
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    How to ship
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/order_guide">How to order</a>
                    </li>
                    <li><a class="dropdown-item" href="/how_to_pack">How to pack</a>
                    </li>
                    <li><a class="dropdown-item" href="/how_to_measure">How to measure</a></li>
                    <li><a class="dropdown-item" href="/prohibited_goods">Prohibited goods</a>
                    </li>
                </ul>
            </div>
            {{--  modal  --}}
            <div class="modal rounded fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog rounded modal-dialog-scrollable modal-lg modal-dialog-centered">
                    <div style="border-radius: 12px" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order Tracking Logs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                  </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="mb-4" action="" method="post">
                                @csrf
                                <label for="tracking">Add Tracking Id</label>
                                <input class="form-control mb-2 rounded" type="text" id="tarcking_id"
                                    name="tarcking_id" value="">
                                    <div class="text-end">
                                <button onclick="trackingFunction()" id="trackingForm" class="btn btn-primary"
                                    type="button">Submit</button>
                                </div>
                            </form>
                            <div class="d-none hide_dev">
                                <h5 class="mb-4">Logs</h5>
                                <table class="table log_table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Country Name</th>
                                            <th>City Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id="logList">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  modal  --}}
            <a class="" data-bs-toggle="modal" data-bs-target="#exampleModal" href="">Tracking</a>
            <a class="" href="{{ route('contact') }}">{{ trans('nav.9') }}</a>
            <div class="nav-item dropdown">
                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    @if ((session('locale') && session('locale') == 'en') || app()->getLocale() == 'en')
                        English
                    @else
                        Italiano
                    @endif
                </a>
                <ul class="dropdown-menu lang-dp" aria-labelledby="navbarDropdown">
                    @if ((session('locale') && session('locale') == 'en') || app()->getLocale() == 'en')
                        <li>
                            <a class="dropdown-item" href="{{ route('set-lang', 'en') }}"><i
                                    class="fa fa-check text-success"></i> English</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('set-lang', 'it') }}">Italiano</a>
                        </li>
                    @else
                        <li>
                            <a class="dropdown-item" href="{{ route('set-lang', 'en') }}">English</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('set-lang', 'it') }}"><i
                                    class="fa fa-check text-success"></i> Italiano</a>
                        </li>
                    @endif
                </ul>
            </div>
            @guest
                @if (Route::has('login'))
                    <a class="bg-primary text-white p-2 rounded-full px-3"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu service-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <a class="" href="{{ route('home') }}">{{ trans('nav.10') }}</a>
            @endguest
        </div>

    </div>
</nav>
<nav class="navbar hidden navbar-expand-lg" id="navbarSupportedContent">

    <div class="block">
        <div>
            <a href="/">{{ trans('nav.1') }}</a>
        </div>
        <div>
            <a href="{{ route('who_we_are') }}">{{ trans('nav.2') }}</a>
        </div>
        <div class="nav-item dropdown">
            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                {{ trans('nav.3') }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('shipping_page') }}">{{ trans('hompage.42') }}</a>
                <a class="dropdown-item" href="{{ route('pick_up_point_page') }}">{{ trans('hompage.46') }}</a>
                <a class="dropdown-item" href="{{ route('showcase') }}">Agro Procuct Trade</a>

                <a class="dropdown-item" href="{{ route('shipping_page') }}">Food Packaging and storage</a>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                How to ship
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/order_guide">How to order</a>
                </li>
                <li><a class="dropdown-item" href="/how_to_pack">How to pack</a>
                </li>
                <li><a class="dropdown-item" href="/how_to_measure">How to measure</a></li>
                <li><a class="dropdown-item" href="/prohibited_goods">Prohibited goods</a>
                </li>
            </ul>
        </div>
        <div>
            <a href="{{ route('contact') }}">{{ trans('nav.9') }}</a>
        </div>
        <!-- Language Dropdown -->
        <div class="nav-item dropdown">
            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                {{ session('locale') == 'en' || app()->getLocale() == 'en' ? 'English' : 'Italiano' }}
            </a>
            <ul class="dropdown-menu lang-dp" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('set-lang', 'en') }}">{!! session('locale') == 'en' || app()->getLocale() == 'en'
                    ? '<i class="fa fa-check text-success"></i> English'
                    : 'English' !!}</a>
                </li>
                <li><a class="dropdown-item" href="{{ route('set-lang', 'it') }}">{!! session('locale') == 'it' || app()->getLocale() == 'it'
                    ? '<i class="fa fa-check text-success"></i> Italiano'
                    : 'Italiano' !!}</a>
                </li>
            </ul>
        </div>
        <!-- Authentication Links -->
        <div class="mt-3">
            @guest
                @if (Route::has('login'))
                    <a class="bg-primary text-white p-2 rounded-full px-3"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
            @else
                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu service-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
                        </form>
                    </ul>
                </div>
                <a href="{{ route('home') }}">{{ trans('nav.10') }}</a>
            @endguest
        </div>

    </div>
</nav>

<style>
    .navbar-toggler {
        outline: none;
        border: none;
    }
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        // Display SweetAlert success message
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@elseif (session('error'))
    <script>
        // Display SweetAlert error message
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif
<script>
    // $(document).ready(function(){
    var _token = '{{ csrf_token() }}';

    function trackingFunction() {
        var tarcking_id = $('#tarcking_id').val();


        let url = "{{ url('ajax-get-batchlogs') }}";

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: {
                '_token': _token,
                'tarckingId': tarcking_id,
            },
            success: function(response) {
                console.log(response.logs);
                if (response.success) {
                    $("#logList").empty();
                    var tr = '<tr></tr>';
                    $.each(response.logs, function(key, value) {
                        console.log(value);
                            tr += '<tr><td>' + value.type + ':</td><td>' + value
                                .country_name + '</td><td>' + value.city_name +
                                '</td></tr>';
                    });
                    $(".hide_dev").removeClass('d-none');
                    $("#logList").html(tr);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $('#yourButton').on('click', trackingFunction);
</script>
