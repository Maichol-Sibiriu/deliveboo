<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;

class PayController extends Controller
{
    public function pay(Request $request) {
        $data = $request->all();
        // dd($data['payment_method_nonce']);
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'xyg6km7tjcfh5hkh',
            'publicKey' => 'qghn6r3vsw6tqbbp',
            'privateKey' => '7b394a59ad46848440f8dc4171434f52'
        ]);

        $nonceFromTheClient = $data['payment_method_nonce'];

        $result = $gateway->transaction()->sale([
            'amount' => '3000.50',
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
              'submitForSettlement' => False
            ]
        ]);

        return response()->json($result);
    }
}
