<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;

class PaymentAction extends Controller
{

    public function __invoke($orderId)
    {

        $order = Order::query()->findOrFail($orderId);

        $ch = curl_init();


        $paymentKey = Setting::query()->where('key', 'payment_key')->first()->value;


        curl_setopt($ch, CURLOPT_URL, "https://sandbox.payler.com/gapi/StartSession");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'order_id' => $order->id,
            'key' => $paymentKey,
            'type' => 'TwoStep',
            'currency' => 'RUB',
            'amount' => intval($order->price),
//            'email' => 'batenko4@gmail.com',
            'return_url_success' => 'http://project-api.test/success',
            'return_url_decline' => 'http://project-api.test/failed'
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        $result = json_decode($result);

        $order->session_id = $result->session_id;

        if(!$order->session_id) {
            abort(404);
        }

        $order->save();


        curl_close($ch);


        if ($result === false) {
            echo 'Ошибка cURL: ' . curl_error($ch);
            return false;
        }


        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, "https://sandbox.payler.com/gapi/Pay");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'key' => $paymentKey,
            'session_id' => $result->session_id
        ]));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);


        curl_close($ch);


        return $result;



    }
}
