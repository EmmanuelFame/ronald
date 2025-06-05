<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function show() {
        return view('topup.payment', [
            'operator' => Session::get('operator'),
            'phone' => Session::get('phone'),
            'amount' => Session::get('amount'),
        ]);
    }

    public function uploadReceipt(Request $request) {
        $request->validate([
            'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('receipt')->store('receipts', 'public');

        TopUpRequest::create([
            'user_id' => Auth::id(),
            'phone' => Session::get('phone'),
            'operator_name' => Session::get('operator.name'),
            'amount' => Session::get('amount'),
            'receipt_path' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('orders.index')->with('success', 'Top-up request submitted.');
    }
}

