<?php

namespace Tests\Unit;

use Tests\TestCase;
use CodeBugLab\NoonPayment\Facades\NoonPayment;

class NoonPaymentTest extends TestCase
{
    public function test_it_returns_initiated_response_values()
    {
        $response = NoonPayment::initiate([
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

        dd($response);
        $this->assertTrue(true);
    }
}
