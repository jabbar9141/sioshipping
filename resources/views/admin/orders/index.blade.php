@extends('admin.app')
@section('page_title', 'Orders')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <form class="justify-content-end d-flex gap-3" action="" method="post">
                        <input style="width: 20%" type="date" id="startDate" name="startDate" class="form-control"
                            id="dateFillter" name="dateFillter" id="">
                        <input style="width:20%" type="date" id="endDate" name="endDate" class="form-control"
                            id="dateFillter" name="dateFillter" id="">
                        <button id="dateFillter" class="btn btn-primary btn-sm" type="button">Save</button>
                    </form>
                </div>
                <h5 class="card-title fw-semibold mb-4">All Orders</h5>
                @include('admin.partials.notification')
                <hr>
                <div class="d">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="orders_tbl" class="table table-sm  table-bordered table-striped display">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Data</th>
                                        <th>Locations</th>
                                        <th>Parties</th>
                                        <th>Price(&euro;)</th>
                                        <th>Status</th>
                                        <th>View / Track</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $("#dateFillter").on('click', function() {
            console.log($("#startDate").val())
            let url = "{{ route('allOrdersList') }}?startDate=" + $("#startDate").val() + "&endDate=" + $(
                "#endDate").val();
            console.log(url);
            $('#orders_tbl').DataTable().ajax.url(url).load();
        });


        $('#orders_tbl').DataTable({
            "dom": 'Bfrtip',
            "iDisplayLength": 50,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "buttons": ['pageLength', 'copy', 'excel', 'csv', 'pdf', 'print', 'colvis'],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('allOrdersList') }}",
                "type": "GET",
                data: function(d) {
                    d.startDate = $("#startDate").val();
                    d.endDate = $("#endDate").val();
                },
            },
            "columns": [{
                    "data": "DT_RowIndex"
                },
                {
                    "data": "date"
                },
                {
                    "data": "location"
                },
                {
                    "data": "parties"
                },
                {
                    "data": "price"
                },
                {
                    "data": "status"
                },
                {
                    "data": "view"
                },
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
