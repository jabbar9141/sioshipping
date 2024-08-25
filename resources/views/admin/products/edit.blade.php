@extends('admin.app')
@section('page_title', 'Create Global Trade Product')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Create Global Trade Product <a href="{{ route('products.index') }}"
                        class="btn btn-primary mb-3">All Products</a></h5>

                @include('admin.partials.notification')
                <hr>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{$product->name}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{$product->description}}</textarea>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="price_per_tonne" class="form-label">Price per Tonne(&euro;)</label>
                            <input type="text" name="price_per_tonne" value="{{$product->price_per_tonne}}" class="form-control" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="price_per_kg" class="form-label">Price per Kg(&euro;)</label>
                            <input type="text" name="price_per_kg" value="{{$product->price_per_kg}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="origin_port" class="form-label">Origin Ports(comma seperated)</label>
                            <input type="text" name="origin_port" value="{{$product->origin_port}}" class="form-control" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="supported_ports" class="form-label">Supported Ports(comma seperated)</label>
                            <input type="text" name="supported_ports" value="{{$product->supported_ports}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="shipping_terms" class="form-label">Shipping Terms</label>
                        <input placeholder="e.g CIF, FOB" type="text" value="{{$product->shipping_terms}}" name="shipping_terms" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image( <small>Leave blank if you don't want to change image</small> )</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection
