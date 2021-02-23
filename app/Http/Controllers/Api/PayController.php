<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;
use Dotenv\Result\Result;

class PayController extends Controller
{
    public function pay(Request $request) {
        $data = $request->all();
        $slug = $data['slug'];
        
        // dd($data);
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'xyg6km7tjcfh5hkh',
            'publicKey' => 'qghn6r3vsw6tqbbp',
            'privateKey' => '7b394a59ad46848440f8dc4171434f52'
        ]);

        $nonceFromTheClient = $data['payment_method_nonce'];

        $total= $data['amount'];

        $result = $gateway->transaction()->sale([
            'amount' => $total,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
              'submitForSettlement' => False
            ]
        ]);

        if ($result->success) {
            
            // return redirect()->route('admin.orders.store', compact('data'));
            return response()->json($result);
        }
        else {
            $slug = $slug . '=failed';
            return redirect()->route('restaurants.show', $slug);
        }
    }
}
