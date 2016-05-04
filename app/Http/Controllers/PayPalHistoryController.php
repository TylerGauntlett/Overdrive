<?php

namespace App\Http\Controllers;

use App\TransactionPaypal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PayPal\Rest;

define('SITE_URL', 'http://overdrive.dev/user/paypalPurchase');

class PayPalHistoryController extends Controller
{

    public function show()
    {
        $userId = Auth::user()->id;

        $transactionDatabse = TransactionPaypal::all()->where('complete', 1)->where('user_id', (string)$userId);

        return view('user.paypalTransactionHistory')->with('transactionDatabse', $transactionDatabse);
    }

    public function get()
    {
        $userId = Auth::user()->id;

        $transactionDatabse = DB::table('transaction_paypals')->get($userId);

        return view('user/paypalTransactionHistory')->with('transactionDatabase', $transactionDatabse);
    }
}

