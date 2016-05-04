<?php

namespace App\Http\Controllers;


use PayPal\Rest;


class PayPalStatusController extends Controller
{
    public function showSuccessfulPayment()
    {
        return view('user.successfulPayment');
    }

    public function showUnsuccessfulPayment()
    {
        return view('user.unsuccessfulPayment');
    }
}

