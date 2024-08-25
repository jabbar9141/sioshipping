<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sign Up Notification</title>
</head>

<body>
    <div class="container">
        <img src="{{ asset('landing/assets/img/gallery/siopay_logo.png') }}" alt="Siopay Logo" height="100px">
        <p>Dear {{$user->name}}</p>
        <p>
            You are recieving this mail because your regiatration on Siopay.eu with email {{$user->email}} was successful<br>
            Welcome to Siopay please proceed to login at <a href="http://siopay.eu">Siopay</a> to Enjoy our services today. <br>
            <br>
            <br>
            Your Registration Number is <b>{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</b>, and you will recieve a mail shortly from our KYC team
            concerning the status of your registration, mail info@siopaay.eu if you have any questions.
            <br>
            Welcome
        </p>
        <hr>
        &copy; {{date('Y')}} <a href="http://siopay.eu">{{env('APP_NAME')}}</a>
    </div>
</body>

</html>

