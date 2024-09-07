<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use App\Models\User;
use App\Models\UserFunds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PaymentRequestController extends Controller
{


    public function index(Request $request)
    {

        if ($request->ajax()) {
            $paymentRequests = PaymentRequest::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            return DataTables::of($paymentRequests)
                ->addIndexColumn()
                ->addColumn('amount', function ($row) {
                    $buttons = '';
                    $buttons = '<td>' . fromEuroView(auth()->user()->currency_id ?? 0, $row->amount) . '</td>';
                    return $buttons;
                })
                ->addColumn('veiw', function ($row) {
                    $buttons = '';
                    $buttons .= '<a class="btn btn-sm btn-primary mx-5" data-bs-toggle="modal" data-bs-target="#' . $row->id . '"><i class="fa fa-eye"></i>Veiw</a> ';
                    $buttons .= ' <div class="modal modal-lg fade" id="' . $row->id . '" tabindex="-1" aria-labelledby="' . $row->id . 'Label"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="' . $row->id . 'Label">Payment Request Attachement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                 <table class="table table-sm w-100 mb-5 table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Iban</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                                <td>' . $row->bankDetail->bank_name . '</td>
                                <td>' . $row->bankDetail->iban . '</td>
                                <td>' . fromEuroView(auth()->user()->currency_id ?? 0, $row->amount) . '</td>
                                <td class="text-center"><span class="badge py-2 text-white bg-info text-dark">' . $row->status . '</span></td>
                            </tr>
                        </tbody>
                    </table>
                                <img class="img-fluid w-100 h-auto" src="' . asset("/uploads/payment/" . $row->reciept_attachement) . '"   ></img>
                            </div>
                             <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
                    return $buttons;
                })
                ->addColumn('bank_detail_id', function ($row) {
                    $bank_name = $row->bankDetail->bank_name;
                    return $bank_name;
                })
                ->addColumn('status', function ($row) {
                    $buttons = '';
                    $buttons .= '<span class="badge py-2 text-white bg-info text-dark">' . $row->status . '</span>';
                    return $buttons;
                })
                ->rawColumns(['veiw', 'bank_detail_id', 'status', 'details', 'amount'])
                ->make(true);
        }
        return redirect()->route('my-wallet.index');
    }


    public function adminget(string $id)
    {
        $paymentRequests = PaymentRequest::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $rep = [];
        $rep['user_id'] = $id;
        return view('agents.settings.wallet', compact('paymentRequests'));
    }


    public function store(Request $request)
    {
        //  return $request->all();
        $request->validate([
            'bank_detail_id' => 'required|numeric',
            'reciept_attachement' => 'required|mimes:png,jpg,pdf,jpeg',
            'amount' => 'required|numeric',
        ]);

        try {
            $attachment = $request->file('reciept_attachement');
            $attachmentName = 'pay_attach_' . time() . '.' . $attachment->getClientOriginalExtension();
            $attachment->move(public_path('uploads/payment'), $attachmentName);


            $paymentRequest = PaymentRequest::create([
                'bank_detail_id' => $request->bank_detail_id,
                'reciept_attachement' => $attachmentName,
                'amount' => $request->amount,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->route('my-wallet.index')->with(
                'message',
                "Payment Request Added Successfully."
            );
        } catch (\Exception $e) {
            Log::error('Error during file upload or payment request creation: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
            ], 500);
        }
    }


    public function getTransit()
    {

        try {
            $transits = UserFunds::get();
            return response()->json([
                'success' => true,
                'data' => $transits,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => 'Some thing went Wrong'
            ]);
        }
    }

    public function acceptPaymentRequest(string $id)
    {

        $paymentRequest = PaymentRequest::find($id);
        if ($paymentRequest) {
            $paymentRequest->status = 'accept';
            $paymentRequest->admin_id = Auth::user()->id;
            $paymentRequest->save();
            $u = updateAccountBalance(Auth::user()->id, $paymentRequest->amount, 'SIO' . rand(99999, 100000) . '-' . $paymentRequest->id, 'debit', 'Admin Wallet Funding');
            $u = updateAccountBalance(Auth::user()->id, $paymentRequest->amount, 'SIO' . rand(99999, 100000) . '-' . $paymentRequest->id, 'credit', 'Admin Transfer Requested amount from Wallet');
            $u = updateAccountBalance($paymentRequest->user_id, $paymentRequest->amount, 'SIO' . rand(99999, 100000) . '-' . $paymentRequest->id, 'debit', 'Wallet Funding');

            return redirect()->back()->with(['message' => 'Status Updated Successfully!', 'message_type' => 'success']);
        } else {
            return redirect()->back()->with('message', "Something went Wrong!");
        }
    }

    public function rejectPaymentRequest(string $id)
    {

        $paymentRequest = PaymentRequest::find($id);

        if ($paymentRequest) {
            $paymentRequest->status = 'reject';
            $paymentRequest->admin_id = Auth::user()->id;
            $paymentRequest->save();
            return redirect()->back()->with(['message' => 'Status Updated Successfully!', 'message_type' => 'success']);
        } else {
            return redirect()->back()->with('message', "Something went Wrong!");
        }
    }
}
