<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;
use App\Order;
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
            // dd($data['dishes']);


            $newOrder = new Order();

            $newOrder->fill($data);
            $saved = $newOrder->save();

            if ($saved) {
                foreach ($data['dishes'] as $key => $dish) {
                    if ($dish == 0) {
                        \array_splice($data['dishes'], $key, 1);
                        \array_splice($data['dishes_id'], $key, 1);
                    }
                }
                dd($data['dishes']);
                $newOrder->dishes()->attach($data['dishes_id'], ['quantity', $data['dishes']]);
            }
            // return redirect()->route();
            // return response()->json($result);
        }
        else {
            $slug = $slug . '=failed';
            return redirect()->route('restaurants.show', $slug);
        }
    }
}
