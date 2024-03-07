<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentAction extends Controller
{



    public static function payment($orderId, $price)
    {

        $ch = curl_init();



        curl_setopt($ch, CURLOPT_URL, "https://sandbox.payler.com/gapi/StartSession");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'order_id' => $orderId,
            'key' => 'ca7782e8-161d-4b99-b5f5-d82795500da5',
            'type' => 'TwoStep',
            'currency' => 'RUB',
            'amount' => $price,
//            'email' => 'batenko4@gmail.com',
            'return_url_success' => 'http://project-api.test/success',
            'return_url_decline' => 'http://project-api.test/failed'
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);


        curl_close($ch);


        if ($result === false) {
            echo 'Ошибка cURL: ' . curl_error($ch);
            return false;
        }

        $result = json_decode($result);


        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, "https://sandbox.payler.com/gapi/Pay");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'key' => 'ca7782e8-161d-4b99-b5f5-d82795500da5',
            'session_id' => $result->session_id
        ]));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);


        curl_close($ch);


        return $result;



    }
}
