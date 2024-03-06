<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentAction extends Controller
{
    public function __invoke()
    {
        $response = Http::post('https://sandbox.payler.com/gapi/StartSession', [
            'order_id' => 777777,
            'key' => 'ca7782e8-161d-4b99-b5f5-d82795500da5',
            'type' => 'TwoStep',
            'session_type' => 0,
            'currency' => 'RUB',
            'amount' => 100,
            'product' => 'payment for product',
            'email' => 'batenko4@gmail.com',
            'return_url_success' => 'http://project-api.test/success',
            'return_url_decline' => 'http://project-api.test/failed'
        ]);

        dd(json_decode($response->body()));
    }
}
