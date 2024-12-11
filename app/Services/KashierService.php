<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KashierService
{
    protected $apiKey;
    protected $hmacKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('KASHIER_API_KEY');
        $this->hmacKey = env('KASHIER_HMAC_KEY');
        $this->baseUrl = env('KASHIER_ENV') === 'sandbox' 
                        ? 'https://checkout.kashier.io/api'
                        : 'https://checkout.kashier.io/api';
    }

    public function createPaymentRequest($amount, $currency, $orderId, $returnUrl)
    {
        $payload = [
            'amount' => $amount,
            'currency' => $currency,
            'merchantOrderId' => $orderId,
            'returnUrl' => $returnUrl,
            'customer' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone ?? '0000000000',
            ]
        ];

        $signature = $this->generateSignature($payload);

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Signature' => $signature,
        ])->post("{$this->baseUrl}/payment", $payload);

        return $response->json();
    }

    protected function generateSignature($payload)
    {
        ksort($payload);
        $flattenedPayload = http_build_query($payload);
        return hash_hmac('sha256', $flattenedPayload, $this->hmacKey);
    }
}
