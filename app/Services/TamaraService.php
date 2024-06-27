<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TamaraService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('TAMARA_API_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhY2NvdW50SWQiOiI3ZDhjM2Q0Mi1mYzI1LTQxYmItODY4NC01NWVhNmFmMDQxNzciLCJ0eXBlIjoibWVyY2hhbnQiLCJzYWx0IjoiODBkYmFjMGJlZjAxNTJkMWI4NjBiYmJhNGUxOWM2NzYiLCJyb2xlcyI6WyJST0xFX01FUkNIQU5UIl0sImlhdCI6MTcxMDY4MTI5OCwiaXNzIjoiVGFtYXJhIn0.RZzJlt7zPDGNTuIpLY8mvmdT2xPaM8uiyJm3WkHoAFEGyHXT9Hmt80Dtbk-pdvSxsaHQ8uAKX0AX25d4VgJX2KadIMM0n-7CSYtraHG361Tkxp7dSMjbFEHxNHVZPlnPjGHolivW_pR8I5E9Z8xiVf977F1tZMa-THdWI3fDNBZon9Q92boR1xdLwhEHeKu6t7lNZ3CtSlxw_x83X2y6_GCQvvqqLFIiFbqQqFJ2zVCcZ1Gyd3myGFwkviFTa7rgBH41kuRUumavTLZwkzfy7VlljXfTlvw6L38vLFJLqS810rbhQm-MFJi59sZ6U3H12RK2aPwubfnVR7Yn5Hm02w');
        $this->apiUrl = env('TAMARA_API_URL', 'https://api-sandbox.tamara.co');
    }

    public function orderDetails($orderDetails)
    {
        return [
            "total_amount" => [
                "amount" => "300",
                "currency" => "SAR"
            ],
            "shipping_amount" => [
                "amount" => "1",
                "currency" => "SAR"
            ],
            "tax_amount" => [
                "amount" => "1",
                "currency" => "SAR"
            ],
            "order_reference_id" => "abd12331-a123-1234-4567-fbde34ae",
            "order_number" => "A123125",
            "discount" => [
                "name" => "Lavui",
                "amount" => [
                    "amount" => 0,
                    "currency" => "SAR"
                ]
            ],
            "items" => [
                [
                    "name" => "Product 1",
                    "type" => 'Sunglasses',
                    "reference_id" => '5',
                    "sku" => "45647",
                    "quantity" => 2,
                    "total_amount" => [
                        "amount" => 200,
                        "currency" => "SAR"
                    ]
                ]
            ],
            "consumer" => [
                "email" => "ibrahim@admin.com",
                "first_name" => "Ibrahim",
                "last_name" => "Essam",
                "phone_number" => 544337766
            ],
            "country_code" => "SA",
            "description" => "Thank you for using lavui.",
            "merchant_url" => [
                "cancel" => "http://127.0.0.1:8000/api/fail-payment",
                "failure" => "http://127.0.0.1:8000/api/fail-payment",
                "success" => "http://127.0.0.1:8000/api/success-payment",
                "notification" => "http://127.0.0.1:8000/api/success-payment"
            ],
            "payment_type" => "PAY_BY_INSTALMENTS",
            "instalments" => "3",
            "shipping_address" => [
                "city" => "Riyadh",
                "country_code" => "SA",
                "first_name" => "Ibrahim",
                "last_name" => "Essam",
                "line1" => "3764 Al Urubah Rd",
                "line2" => "3764 Al Urubah Rd",
                "phone_number" => "532298658",
                "region" => "As Sulimaniyah"
            ]
        ];
    }

    public function checkTamaraIsAvailable(array $orderDetails)
    {
        return Http::withHeaders([
            'authorization' => 'Bearer ' . $this->apiKey,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post($this->apiUrl . '/checkout/payment-options-pre-check', $orderDetails)->collect()->toArray();
    }

    public function createCheckout(array $orderDetails)
    {
        return Http::withHeaders([
            'authorization' => 'Bearer ' . $this->apiKey,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post($this->apiUrl . '/checkout', $orderDetails)->collect()->toArray();
    }

    public function authorizeOrder(string $orderId)
    {
        return Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $this->apiKey,
        ])->post($this->apiUrl . "/orders/$orderId/authorise")->collect()->toArray();
    }

    public function captureOrder(array $orderDetails)
    {
        return Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $this->apiKey,
            'content-type' => 'application/json',
        ])->post($this->apiUrl . '/payments/capture', $orderDetails)->collect()->toArray();
    }
}
