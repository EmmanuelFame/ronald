<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\ReloadlyService;

class ReloadlyController extends Controller
{
    protected $reloadly;

    public function __construct(ReloadlyService $reloadly)
    {
        $this->reloadly = $reloadly;
    }

    public function autoDetectOperator(Request $request)
    {
        $phone = $request->input('phone');
        $countryIsoCode = $request->input('country');

        try {
            $response = Http::withToken($this->reloadly->getAccessToken())
                ->get($this->reloadly->baseUrl() . "/operators/auto-detect/phone/{$phone}/countries/{$countryIsoCode}");

            return response()->json($response->json(), $response->status());
        } catch (\Throwable $e) {
            Log::error("Auto-detect error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to auto-detect operator.'], 500);
        }
    }

    public function getOperatorsByCountry($countryCode)
    {
        $response = Http::withToken($this->reloadly->getAccessToken())
            ->get($this->reloadly->baseUrl() . "/operators/countries/{$countryCode}?includeBundles=true");

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch operators'], 500);
        }

        $filtered = collect($response->json())
            ->filter(fn ($op) => $op['operatorType'] === 'AIRTIME')
            ->map(fn ($op) => [
                'id' => $op['id'],
                'name' => $op['name'],
                'prefixes' => $op['senderPhonePrefixes'] ?? [],
                'minDenomination' => $op['denominationType'] === 'RANGE' ? [
                    'amount' => $op['minAmount'],
                    'currencyCode' => $op['currencyCode'],
                ] : null,
                'logoUrls' => $op['logoUrls'] ?? [],
            ])
            ->values();

        return response()->json($filtered);
    }

    public function getCountries()
    {
        try {
            $response = Http::withToken($this->reloadly->getAccessToken())
                ->get($this->reloadly->baseUrl() . "/countries");

            return response()->json($response->json(), $response->status());
        } catch (\Throwable $e) {
            Log::error("Get countries error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch countries'], 500);
        }
    }

    public function getOperatorById($operatorId)
    {
        $response = Http::withToken($this->reloadly->getAccessToken())
            ->accept('application/com.reloadly.topups-v1+json')
            ->get($this->reloadly->baseUrl() . "/operators/{$operatorId}");

        if ($response->failed()) {
            return response()->json(['error' => 'Could not fetch operator details.'], 500);
        }

        return response()->json($response->json());
    }
}
