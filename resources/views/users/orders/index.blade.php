@extends('admin.app')
@section('page_title', 'Orders')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">My Orders</h5>

                @include('admin.partials.notification')
                <hr>
                <div class="d">
                    <div class="card-header">
                        <a href="{{ route('orders.create') }}" class="btn btn-primary float-right">New Order</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h5>Shipping Rates</h5>
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
                                        <th>Edit</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
                <div id="deleteModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <h4 class="text-center">Are you sure you want to delete the following location?</h4>
                                <br />
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <input type="hidden" class="form-control" id="id_delete">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                                    <span id="" class='glyphicon glyphicon-trash'></span> Delete
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
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
                    "url": "{{ route('myOrdersList') }}",
                    "type": "GET"
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
                    {
                        "data": "edit"
                    },
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
