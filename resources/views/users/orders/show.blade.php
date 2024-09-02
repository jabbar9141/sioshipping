@extends('admin.app')
@section('page_title', 'Orders')
@section('content')
    {{-- https://github.com/bitjson/qr-code --}}
    <script src="https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js"></script>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">My Orders</h5>
                @include('admin.partials.notification')
                <hr>
                <div class="card">
                    <div class="card-header">
                        {{-- <a href="{{ route('orders.index') }}" class="btn btn-danger float-right"><i
                                class="fa fa-times"></i>Exit</a> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="print_section">
                            <h5>Tracking ID: [{{ $order->tracking_id }}]</h5>
                            <div class="table-reponsive">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                        <tr>
                                            <th colspan="2">
                                                <div style="">
                                                    <svg id="barcode" style="width: 100px; height: 100px;"></svg><br>
                                                </div>
                                            </th>
                                            <th colspan="2" style="text-align: end">
                                                <img src="{{ asset('admin_assets/assets/images/logos/favicon.png') }}"
                                                    style="width: 42%" slot="icon" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Origin</th>
                                            <td>
                                                <b>Origin</b>:
                                                {{ $order->pickupCountry->name . ', ' . $order->pickupCity->name }}
                                                <p style="margin: 0px !important" class="text-nowrap">[Lat:
                                                    {{ $order->pickupCity->latitude }}, Long:
                                                    {{ $order->pickupCity->longitude }}]</p>
                                                <br>
                                                <b>Picked up at :</b>
                                                {{ $order->pickup_time }}
                                            </td>
                                            <th>Destination / Current Location </th>
                                            <td>
                                                <b>Destination</b>:
                                                {{ $order->deliveryCountry->name . ', ' . $order->deliveryCity->name }}
                                                <p style="margin: 0px !important" class="text-nowrap">
                                                    [Lat:{{ $order->deliveryCity->latitude }}, Long:
                                                    {{ $order->deliveryCity->longitude }}]</p>
                                                {{-- <br> --}}

                                                <b>Current Location</b> :
                                                {{ $order->currentCountry->name . ', ' . $order->currentCity->name }}
                                                <p style="margin: 0px !important" class="text-nowrap">
                                                    [Lat:{{ $order->currentCity->latitude }},
                                                    Long:{{ $order->currentCity->longitude }}]</p>
                                                {{-- <br> --}}
                                                <b>Shipping Cost : </b> {{ number_format($order->shipping_cost, 2) }}
                                                <br>


                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <span class="badge bg-secondary">{{ $order->status }}</span>

                                                    @if ($order->status == 'unpaid')
                                                        <form action="{{ route('cancelOrder') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{ $order->id }}"
                                                                name="order_id">
                                                            <button class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you wish to cancel this order')">Cancel
                                                                Orrder</button>
                                                        </form>
                                                    @endif
                                                </div>

                                            </td>
                                            <th>Price(&euro;)</th>
                                            <td>{{ number_format($order->val_of_goods + $order->shipping_cost, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sender Name</th>
                                            <td>{{ $order->pickup_name }}</td>
                                            <th>Reciever Name</th>
                                            <td>{{ $order->delivery_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sender Email</th>
                                            <td>{{ $order->pickup_email }}</td>
                                            <th>Reciever Email</th>
                                            <td>{{ $order->delivery_email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sender Phone</th>
                                            <td>
                                                {{ $order->pickup_phone }},
                                                {{ $order->pickup_phone_alt }}
                                            </td>
                                            <th>Reciever Phone</th>
                                            <td>
                                                {{ $order->delivery_phone }},
                                                {{ $order->delivery_phone_alt }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sender Address </th>
                                            <td>
                                                {{ $order->pickup_address1 }}
                                                <br>
                                                {{ $order->pickup_address2 }}
                                            </td>
                                            <th>Reciever Address </th>
                                            <td>
                                                {{ $order->delivery_address1 }}
                                                <br>
                                                {{ $order->delivery_address2 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sender Zip/ Postcode</th>
                                            <td>{{ $order->pickup_zip }}</td>
                                            <th>Reciever Zip/ Postcode</th>
                                            <td>{{ $order->delivery_zip }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sender City</th>
                                            <td>{{ $order->pickup_city }}</td>
                                            <th>Reciever City</th>
                                            <td>{{ $order->delivery_city }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sender State/ Province</th>
                                            <td>{{ $order->pickup_state }}</td>
                                            <th>Reciever State/ Province</th>
                                            <td>{{ $order->delivery_state }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sender Country / Region</th>
                                            <td>{{ $order->pickup_country }}</td>
                                            <th>Reciever Country / Region</th>
                                            <td>{{ $order->delivery_country }}</td>
                                        </tr>
                                        <tr>
                                            <th>Condition of Goods</th>
                                            <td>{{ $order->cond_of_goods }}</td>
                                            <th>Value of goods</th>
                                            <td>{{ number_format($order->val_of_goods, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <h5>Order Contents</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <th>Package Type</th>
                                        <th>length(cm)</th>
                                        <th>Width(cm)</th>
                                        <th>Height(cm)</th>
                                        <th>Weight(Kg)</th>
                                        <th>Count/qty</th>
                                    </thead>
                                    <tbody id="items_list">
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->type }}
                                                </td>
                                                <td>
                                                    {{ $item->length }}
                                                </td>
                                                <td>
                                                    {{ $item->width }}
                                                </td>
                                                <td>
                                                    {{ $item->height }}
                                                </td>
                                                <td>
                                                    {{ $item->weight }}
                                                </td>
                                                <td>
                                                    {{ $item->qty }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary" onclick="PrintElem('print_section')">Print Label</button>
                        <hr>
                        <h5>Geolocation Data</h5>
                        <hr>
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"
        integrity="sha256-UuAyU0w/mJdq2Vy4wguvgO0MyD1CWQYCqM8dsW4uIu0=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            let trakingId = "TID_{{ $order->tracking_id }}"
            JsBarcode("#barcode", trakingId, {
                format: "CODE128"
            });
        });
        // Get latitude and longitude values for the two locations from the server
        var latitude1 = {{ $order->pickupCity->latitude }};
        var longitude1 = {{ $order->pickupCity->longitude }};
        var latitude2 = {{ $order->deliveryCity->latitude }};
        var longitude2 = {{ $order->deliveryCity->longitude }};
        var latitude3 = {{ $order->currentCity->latitude }};
        var longitude3 = {{ $order->currentCity->longitude }};

        // Initialize the map
        var map = L.map('map').setView([latitude1, longitude1], 5);

        // Add OpenStreetMap as the base layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add markers
        // for the two locations
        var marker1 = L.marker([latitude1, longitude1]).addTo(map).bindPopup('{{ $order->pickupCity->name }}');
        var marker2 = L.marker([latitude2, longitude2]).addTo(map).bindPopup('{{ $order->deliveryCity->name }}');
        var marker3 = L.marker([latitude3, longitude3]).addTo(map).bindPopup(
            '{{ $order->currentCity->name }} - Cur. loc.').openPopup();;

        // Create a polyline between the two markers
        // Create a blue polyline between origin and current location
        var bluePolyline = L.polyline([
            [latitude1, longitude1],
            [latitude3, longitude3]
        ], {
            color: 'blue'
        }).addTo(map);

        // Create a gray polyline between cur location and destination
        var grayPolyline = L.polyline([
            [latitude3, longitude3],
            [latitude2, longitude2]
        ], {
            color: 'gray'
        }).addTo(map);

       
        map.fitBounds([latitude1, longitude1], [latitude2, longitude2]);
    </script>
    <script>
        function PrintElem(elem) {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title + '</title>');
            mywindow.document.write(
                `<link rel="stylesheet" href="{{ asset('admin_assets/assets/css/styles.min.css') }}" />`);
            mywindow.document.write('</head><body>');
            mywindow.document.write(
                `<link rel="preload" href="https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js" as="script">`);
            var script = document.createElement('script');
            script.src = 'https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js';
            mywindow.document.head.appendChild(script);

            mywindow.document.write(document.getElementById(elem).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // IE >= 10

            // Wait for the window and its contents to load
            mywindow.onload = function() {
                mywindow.focus(); // Set focus for IE
                mywindow.print();
                // Optional: Uncomment the line below to close the window after printing
                // mywindow.close();
            };

            return true;
        }
    </script>
@endsection
