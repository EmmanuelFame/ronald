<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReloadlyService
{
   public function getAccessToken()
{
    try {
        $payload = [
            'client_id' => env('RELOADLY_CLIENT_ID'),
            'client_secret' => env('RELOADLY_CLIENT_SECRET'),
            'grant_type' => 'client_credentials',
            'audience' => 'https://topups-sandbox.reloadly.com',
        ];

        Log::info('Reloadly token request payload:', $payload);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://auth.reloadly.com/oauth/token', $payload);

        if ($response->failed()) {
            Log::error('Reloadly token error response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            throw new \Exception("Failed to retrieve Reloadly access token");
        }

        return $response->json()['access_token'];

    } catch (\Throwable $e) {
        Log::error("Exception during token fetch: " . $e->getMessage());
        throw new \Exception("Failed to retrieve Reloadly access token");
    }
}


    public function baseUrl()
    {
        return env('RELOADLY_BASE_URL', 'https://topups-sandbox.reloadly.com');
    }
}
