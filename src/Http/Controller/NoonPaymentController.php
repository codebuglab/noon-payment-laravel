<?php

namespace App\Http\Controllers;

use CodeBugLab\NoonPayment\NoonPayment;
use Illuminate\Http\Request;

class NoonPaymentController extends Controller
{

    public function index()
    {
        $response = NoonPayment::getInstance()->initiate([
            "order" => [
                "reference" => "1",
                "amount" => "10",
                "currency" => "SAR",
                "name" => "Sample order name",
            ],
            "configuration" => [
                "locale" => "en"
            ]
        ]);

        if ($response->resultCode == 0) {
            return redirect($response->result->checkoutData->postUrl);
        }

        return $response->message;
    }

    public function response(Request $request)
    {
        $response = NoonPayment::getInstance()->getOrder($request->orderId);

        if (
            $response->result->transactions[0]->type == "SALE" &&
            $response->result->transactions[0]->status == "SUCCESS"
        ) {
            //success
            return "Transaction Success";
        }
        // cancel
        return "Transaction Canceled";
    }
}
