<?php

namespace CodeBugLab\NoonPayment;

use CodeBugLab\NoonPayment\Helper\CurlHelper;

class NoonPayment
{
    private static $instance = null;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new NoonPayment();
        }
        return self::$instance;
    }

    public function initiate($paymentInfo)
    {
        $paymentInfo['apiOperation'] = "INITIATE";
        $paymentInfo['order']['channel'] = config("noon_payment.channel");
        $paymentInfo['order']['category'] = config("noon_payment.order_category");
        // Options for tokenize cc are (true - false)
        $paymentInfo['configuration']['tokenizeCc'] = (!empty($paymentInfo['configuration']['tokenizeCc'])) ? $paymentInfo['configuration']['tokenizeCc'] : "true";
        $paymentInfo['configuration']['returnUrl'] = (!empty($paymentInfo['configuration']['returnUrl'])) ? $paymentInfo['configuration']['returnUrl'] : config('noon_payment.return_url');
        // Options for payment action are (AUTHORIZE - SALE)
        $paymentInfo['configuration']['paymentAction'] = (!empty($paymentInfo['configuration']['paymentAction'])) ? $paymentInfo['configuration']['paymentAction'] : "SALE";

        return json_decode(CurlHelper::post(config("noon_payment.payment_api") . "order", $paymentInfo, $this->getHeaders()));
    }

    public function getOrder($orderId)
    {
        return json_decode(CurlHelper::get(config("noon_payment.payment_api") . "order/" . $orderId, $this->getHeaders()));
    }

    private function getHeaders()
    {
        return [
            "Content-type: application/json",
            "Authorization: Key_" . config("noon_payment.mode") . " " . config("noon_payment.auth_key"),
        ];
    }
}
