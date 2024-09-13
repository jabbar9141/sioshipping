<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Order Batch Mail</title>
</head>

<body>
    <div class="contianer">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Batch</th>
                            <td>
                                @foreach ($orders as $order)
                            <th>Current Locatoin:</th>
                            <p style="margin: 0px !important" class="text-nowrap">[ 
                                {{ $order->current_location->country->name }}]</p>
                            <br>
                            </td>
                            <th>Delivery Location</th>
                            <td>
                                <p style="margin: 0px !important" class="text-nowrap">[
                                    {{ $order->delivery_location->Country->name }}]</p>
                                <br>
                            </td>
                        </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                                </td>
                                <th>Price(&euro;)</th>
                                <td>{{ $order->val_of_goods }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Cost</th>
                                <td>{{ $order->shipping_cost }}</td>
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
                                <td>{{ $order->pickup_phone }}</td>
                                <th>Reciever Name</th>
                                <td>{{ $order->delivery_phone }}</td>
                            </tr>
                            <tr>
                                <th>Sender Phone Alt.</th>
                                <td>{{ $order->pickup_phone_alt }}</td>
                                <th>Reciever Phone Alt.</th>
                                <td>{{ $order->delivery_phone_alt }}</td>
                            </tr>
                            <tr>
                                <th>Sender Address 1</th>
                                <td>{{ $order->pickup_address1 }}</td>
                                <th>Reciever Address 1</th>
                                <td>{{ $order->delivery_address1 }}</td>
                            </tr>
                            <tr>
                                <th>Sender Address 2</th>
                                <td>{{ $order->pickup_address2 }}</td>
                                <th>Reciever Name</th>
                                <td>{{ $order->delivery_address2 }}</td>
                            </tr>
                            <tr>
                                <th>Sender Country / Region</th>
                                <td>{{ $order->pickup_country }}</td>
                                <th>Reciever Country / Region</th>
                                <td>{{ $order->delivery_country }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
