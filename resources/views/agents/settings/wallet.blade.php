@php
    use App\Models\BankDetail;
    use App\Models\PaymentRequest;
    $bank_details = BankDetail::select('id', 'bank_name', 'iban')->get();
@endphp
@extends('admin.app')
@section('page_title', 'Wallet')
@section('content')
    <script src="https://js.stripe.com/v3/"></script>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h5 class="card-title fw-semibold mb-4">My Wallet</h5>
                </div>
                {{-- <p class="mb-0">This is the Agent Wallet page </p> --}}
                {{-- @include('dispatcher.settings.nav') --}}
                @include('admin.partials.notification')
                <hr>
                @if (Auth::user()->user_type == 'admin')
                    <table id="paymentRequestList" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Bank Name</th>
                                <th>Iban No</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Accept</th>
                                <th>Reject</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentRequests as $request)
                                <tr>
                                    <td> {{ $request->id }}</td>
                                    <td> {{ $request->bankDetail?->bank_name }}</td>
                                    <td> {{ $request->bankDetail?->iban }}</td>
                                    <td> {{ $request->bankDetail?->country->name }}</td>
                                    <td> {{ $request->bankDetail?->city->name }}</td>
                                    <td> {{ $request->amount }}</td>
                                    <td> {{ $request->status }}</td>
                                    <td> <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin-accept-paymentRequest', $request->id) }}">Accept</a></td>
                                    <td> <a class="btn btn-info btn-sm"
                                            href="{{ route('admin-reject-paymentRequest', $request->id) }}">Reject</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Payment Request</h5>
                        </div>
                        <div class="card-body">
                            <h4>Wallet History</h4>
                            <h6 class="hide-menu">Today's Commission (&euro;):
                                {{ getAccountbalances(Auth::id())['earningsToday'] }}</h6>
                            <h6 class="hide-menu">Today's Spendings (&euro;):
                                {{ number_format(getAccountbalances(Auth::id())['spentToday'], 2) }}</h6>
                            <h6 class="hide-menu">Account Balance (&euro;):
                                {{ number_format(getAccountbalances(Auth::id())['balance'], 2) }}</h6>
                            <hr>
                            <form class="mb-5" id="paymentRequest" action="{{ route('paymentRequestpost') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <label for="bank_name">Name of Bank<i class="text-danger">*</i>:</label>
                                        <select name="bank_detail_id" id="bank_detail_id" class="form-control">
                                            <option value="">Select Bank</option>
                                            @foreach ($bank_details as $bank_detail)
                                                <option value="{{ $bank_detail->id }}">{{ $bank_detail->bank_name }},
                                                    {{ $bank_detail->iban }}</option>
                                            @endforeach
                                        </select>
                                        @error('bank_detail_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="file">Receipt Attachment<i class="text-danger">*</i>:</label>
                                        <input type="file" name="reciept_attachement" id="reciept_attachement"
                                            class="form-control">
                                        @error('reciept_attachement')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <label for="amount">Amount<i class="text-danger">*</i>:</label>
                                        <input type="number" name="amount" id="amount" class="form-control">
                                        @error('amount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>All Payment Requests</h5>
                        </div>
                        <div class="card-body">
                            <style>
                                #paymentRequestList tr th {
                                    width: 20% !important;
                                    text-align: center;
                                }
                            </style>
                            <table id="paymentRequestList" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/No</th>
                                        <th>Bank Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                {{--  <div class="row">
                    <div class="col-sm-8">
                        
                        <form action="" method="get" class="from-inline">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="date" name="date_from" id="date_from" class="form-control"
                                        placeholder="Start date">
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" name="date_to" id="date_to" class="form-control"
                                        placeholder="End date">
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Get History</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        @if (isset($wallet_history))
                            <table class="table table-sm table-stripped table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Amount(&euro;)</th>
                                    <th>ID</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>

                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($wallet_history as $history)
                                        <tr>
                                            <td>
                                                {{ $i }}
                                            </td>
                                            <td>
                                                @if ($history->flag = 'debit')
                                                    {{ $history->amount }}
                                                @else
                                                    -{{ $history->amount }}
                                                @endif
                                            </td>
                                            <td>{{ $history->transId }}</td>
                                            <td>{{ $history->created_at }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <h4>Deposit Into wallet</h4>
                        @if (null != request()->get('deposit_amt'))
                            <form id="payment-form" data-secret="{{ $stripeIntent->client_secret }}">
                                <div id="payment-element">
                                    <!-- Elements will create form elements here -->
                                </div>
                                <br>
                                <button id="submit" class="btn btn-primary btn-lg">Pay Now</button>
                                <div id="error-message">
                                    <!-- Display error message to your customers here -->
                                </div>
                            </form>
                        @else
                            <form action="" method="get">
                                @csrf
                                <div class="form-group">
                                    <label for="amount">Deposit Amount(&euro;)</label>
                                    <input type="number" name="deposit_amt" class="form-control" id="amount"
                                        required>
                                </div>
                                <br>
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                            </form>
                        @endif
                    </div>
                </div>  --}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (null != request()->get('deposit_amt'))
        <script>
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');

            const options = {
                clientSecret: '{{ $stripeIntent->client_secret }}',
                appearance: {},
            };
            const elements = stripe.elements(options);

            const paymentElement = elements.create('payment');
            paymentElement.mount('#payment-element');

            const form = document.getElementById('payment-form');

            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                $('#submit').attr('disabled', true);
                $('#error-message').text('Payment Processing...please wait')
                const {
                    error
                } = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: "{{ route('my-wallet.store') }}",
                    },
                });

                if (error) {

                    const messageContainer = document.querySelector('#error-message');
                    messageContainer.textContent = error.message;
                } else {

                }
            });
        </script>
    @endif
    @if (Auth::user()->user_type !== 'admin')
        <script>
            $(document).ready(function() {
                var table = $('#paymentRequestList').DataTable({
                    "dom": 'Bfrtip',
                    "iDisplayLength": 50,
                    "lengthMenu": [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    "buttons": ['pageLength', 'copy', 'excel', 'csv', 'pdf', 'print', 'colvis'],
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('paymentRequestget') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'bank_detail_id',
                            name: 'bank_detail_id'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'veiw',
                            name: 'veiw',
                            searchable: false
                        }
                    ]
                });

                table.ajax.reload();
            });
        </script>
    @endif

@endsection
