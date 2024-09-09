@extends('admin.app')
@section('page_title', 'Shipping Costs')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Countries Shipping Costs</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="countriesShippingCostTable" class="table table-sm  table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>ISO 2</th>
                                <th>Shipping Cost (Min-Max) €</th>
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
        $('#countriesShippingCostTable').DataTable({
            "dom": 'Bfrtip',
            "iDisplayLength": 20,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "buttons": ['pageLength', 'copy', 'excel', 'csv', 'pdf', 'print', 'colvis'],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('shippingRatesList') }}",
                "type": "GET"
            },
            "columns": [{
                    "data": "DT_RowIndex"
                },
                {
                    "data": "name"
                },


                {
                    "data": "iso2"
                },
                {
                    "data": "shipping_cost"
                },
                {
                    "data": "action"
                },
                // {
                //     "data": "max_dimensions"
                // },
                // {
                //     "data": "view"
                // },
                // {
                //     "data": "edit"
                // },
                // {
                //     "data": "delete"
                // }
            ],
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
    </script>
@endsection
