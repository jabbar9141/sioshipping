@extends('admin.app')
@section('page_title', 'Edit Batch')
@section('content')
    <div class="container-fluid">
        {{-- <div class="card"> --}}
        {{-- <div class="card-body"> --}}
        {{-- <h5 class="card-title fw-semibold mb-4">Settings</h5> --}}
        {{-- @include('dispatcher.settings.nav') --}}
        {{-- <hr> --}}
        <div class="card">
            <div class="card-header">
                <h5>Add Batch Log</h5>
                {{-- <a href="{{ route('batches.index') }}" class="btn btn-danger float-right"><i class="fa fa-times"></i>Exit</a> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include('admin.partials.notification')
                <div class="d-flex gap-5">
                <p><b>Batch Name : {{ $batch->name }}</b></p>
                <p><b>Batch Trackind : {{ $batch->batch_tracking_id }}</b></p>
            </div>
                
                <form action="{{ route('batches.update', $batch->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="ui-widget">
                                <label for="origin">Shipping From Country </label>
                                <input type="text" id="origin" name="origin_" value="{{ $batch->batchlogs->first()->shipFromCountry->name }}"
                                    class="form-control" autocomplete="off" readonly>
                               
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ui-widget">
                                <label for="origin">Shipping From City </label>
                                <input type="text" id="origin" name="origin_" value="{{ $batch->batchlogs->first()->shipFromCity->name }}"
                                    class="form-control" autocomplete="off" readonly>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="ui-widget">
                                <label for="origin">Shipping To Country </label>
                                <input type="text" id="origin" name="origin_" value=""
                                    class="form-control" autocomplete="off" readonly>
                               
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ui-widget">
                                <label for="origin">Shipping To City </label>
                                <input type="text" id="origin" name="origin_" value=""
                                    class="form-control" autocomplete="off" readonly>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="assigned" {{ $batch->status == 'assigned' ? 'selected' : '' }}>Processing
                                </option>
                                <option value="in_transit" {{ $batch->status == 'in_transit' ? 'selected' : '' }}>In
                                    Transit</option>
                                <option value="delivered" {{ $batch->status == 'delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="cancelled" {{ $batch->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                    </div>
                  
                    <br>
                    <button type="submit"
                        onclick="return confirm('Are you sure you wish to update this batch, all changes set will affect all associated orders')"
                        class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    {{-- </div> --}}
@endsection
@section('scripts')
    <script>
        $('#origin').autocomplete({
            source: "{{ route('locations.search') }}",
            minLength: 1,
            select: function(event, ui) {
                // Update the hidden input field with the selected value
                $('#origin_id').val(ui.item.value);

                // Update the visible input field with the label
                $('#origin').val(ui.item.label);

                // Prevent the default behavior of filling the input with the label
                event.preventDefault();
            }
        });
    </script>
@endsection
