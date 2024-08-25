<?php

namespace App\Http\Controllers;

use App\Mail\InquiryNotification;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'email' => 'required|email',
            'shipping_location' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
        ]);

        $product = Product::find($request->product_id);

        // Save the inquiry
        Inquiry::create($request->except('_token'));

        // Send the email notification
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new InquiryNotification($product, $request->except('_token')));

        return back()->with('success', 'Your inquiry has been submitted successfully.');
    }
}
