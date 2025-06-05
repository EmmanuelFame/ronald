<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\TopUpRequest;

class OrderController extends Controller
{
    public function index() {
        $orders = TopUpRequest::where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }
}




