<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopUpRequest;

class TopUpRequestController extends Controller
{
    public function index()
    {
        $requests = TopUpRequest::with('user')->latest()->get();
        return view('admin.topups.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = TopUpRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();

        return back()->with('success', 'Request approved.');
    }

    public function reject($id)
    {
        $request = TopUpRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return back()->with('error', 'Request rejected.');
    }
}

