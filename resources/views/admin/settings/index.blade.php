@extends('admin.app')
@section('page_title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Settings</h5>
                <p class="mb-0">This will be the Admin settings page </p>
                @include('admin.settings.nav')
            </div>
        </div>
    </div>
@endsection
