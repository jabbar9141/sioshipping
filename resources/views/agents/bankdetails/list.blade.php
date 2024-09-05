@extends('admin.app')
@section('page_title', 'Currency Exchange Rates')
@section('content')
    <div class="container-fluid">
        <div class="card mb-3">
            @include('admin.partials.notification');
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Bank Details</h5>
                <a class="btn btn-primary" href="{{ route('bank_details.create') }}">Add New</a>
            </div>
        {{--  </div>
        <div class="card">  --}}
            <div class="card-body">
                <div class=""></div>
                <div class="table-responsive">
                    <table id="bankDetailsList" class="table table-sm w-100  table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Iban</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(function() {
            var table = $('#bankDetailsList').DataTable({
                "dom": 'Bfrtip',
                "iDisplayLength": 50,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                "buttons": ['pageLength', 'copy', 'excel', 'csv', 'pdf', 'print', 'colvis'],
                processing: true,
                serverSide: true,
                ajax: "{{ route('bank_details.index') }}",
      
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'bank_name',
                        name: 'bank_name'
                    },
                    {
                        data: 'iban',
                        name: 'iban'
                    },
                    {
                        data: 'country_id',
                        name: 'country_id',
                    },
                    {
                        data: 'city_id',
                        name: 'city_id',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
