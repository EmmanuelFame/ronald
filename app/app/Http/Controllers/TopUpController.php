<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Services\ReloadlyService;

class TopUpController extends Controller
{
        protected $reloadly;

        public function __construct(ReloadlyService $reloadly)
        {
            $this->reloadly = $reloadly;
        }

        public function index() {
            return view('topup.index');
        }
    
    public function detectOperator(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'country' => 'required|string',
        ]);

        try {
            $accessToken = $this->reloadly->getAccessToken();

            $url = $this->reloadly->baseUrl() . "/operators/auto-detect/phone/{$request->phone}/countries/{$request->country}";

            $res = Http::withToken($accessToken)->get($url);

            if (!$res->successful()) {
                return response()->json(['success' => false, 'message' => 'Operator not found'], 404);
            }

            $operator = $res->json();

            return response()->json([
                'success' => true,
                'operator' => [
                    'name' => $operator['name'],
                    'logo_url' => $operator['logoUrls'][0] ?? '',
                    'min_amount' => $operator['minAmount'] ?? 0,
                    'currency' => $operator['currencyCode'] ?? 'NGN', // default fallback
                ]
            ]);
        } catch (\Throwable $e) {
            Log::error("Operator detection failed: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal server error'], 500);
        }
    }
    
    public function submitAmount(Request $request) 
    {
        $request->validate([
            'amount' => 'required|numeric|min:50',
            'phone' => 'required|string',
            'operator_name' => 'required|string',
        ]);

        Session::put('amount', $request->amount);
        Session::put('phone', $request->phone);
        Session::put('operator.name', $request->operator_name);

        return redirect()->route('payment.show');
    }


        public function showPaymentPage(Request $request)
    {
        $phone = $request->query('phone');
        $amount = $request->query('amount');
        $operatorName = $request->query('operator');

        if (!$phone || !$amount || !$operatorName) {
            abort(400, 'Missing required data');
        }

        Session::put('phone', $phone);
        Session::put('amount', $amount);
        Session::put('operator.name', $operatorName);

        return view('topup.payment', [
            'phone' => $phone,
            'amount' => $amount,
            'operator' => $operatorName,
        ]);
    }



    
}