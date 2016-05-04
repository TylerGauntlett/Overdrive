<?php

namespace App\Http\Controllers;

use App\TransactionPaypal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest;

define('SITE_URL', 'http://overdrive.dev/user/paypalPurchase');

class PayPalController extends Controller
{
    protected $services;


    public function __construct()
    {
        $this->services = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AbO23qMEdF7Cr_2Og6gwLsSjiTb3wOjlJyBRPOYA9L9R6Bfjf0dG_SFPb2Idn_-PDuoeS2oCIGGrryi0',
                'EMldIYgsxS8GqWx3T0mbNIukxXh7P8i0YJc6cZDkoI-VyXjsYneLT6yI1sOnLIaVucd3YvCsKaSXpQuS'
            )
        );
    }

    public function show()
    {
        return view('user.paypalPurchase');
    }

    public function post(Request $request)
    {
        $paypal = $this->services;

        $product = $request->input('product');

        $price = $request->input('price');

        $user = Auth::user()->id;

        if (empty ($product) || empty($price))
        {
            \Session::flash('flash_message', "Please enter valid fields");

            return redirect('user/paypalPurchase');
        }

        if(!is_numeric ($price))
        {
            \Session::flash('flash_message', "Please enter price as a number");

            return redirect('user/paypalPurchase');
        }


        $shipping = 2.00;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($price);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('PayForSomething Payment')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(SITE_URL . '/pay?success=true')
            ->setCancelUrl(SITE_URL . '/pay?success=false');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($paypal);

        } catch(\Exception $e) {
            die($e);
        }

        $paypalDatabase = [
            "product" => $product,
            "price" => $price,
            "user_id" => $user
        ];

        $paypalDatabase = TransactionPaypal::create($paypalDatabase);

        $approveUrl = $payment->getApprovalLink();

        header("Location: {$approveUrl}");
    }

    public function validatePayment()
    {
        $paypal = $this->services;
        $success = Input::get('success');
        $payerId = Input::get('PayerID');
        $paymentId = Input::get('paymentId');
        $user = Auth::user()->id;
        $complete = false;


        if($success == "true")
        {
            $complete = true;
        }

        if($complete)
        {
            $paypalDatabase = [
                "payer_id" => $payerId,
                "payment_id" => $paymentId,
                "complete" => $complete
            ];

            DB::table('transaction_paypals')->where('user_id', $user)->latest('created_at')->update($paypalDatabase);

            DB::table('users')->where('id', $user)->update(['member'=> 1]);

        }


        if(!$complete)
        {
            \Session::flash('flash_message', "Payment Failed.");

            return redirect('user/unsuccessfulPayment');
        }

        if (!isset ($success, $payerId, $paymentId))
        {
            \Session::flash('flash_message', "Payment Failed.");

            return redirect('user/unsuccessfulPayment');
        }

        $payment = Payment::get($paymentId, $paypal);



        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try{
            $result = $payment->execute($execute, $paypal);
        } catch (\Exception $e)
        {
            \Session::flash('flash_message', "Payment Failed.");

            return redirect('user/unsuccessfulPayment');
        }


        \Session::flash('flash_message', "Payment Successful.");


        return redirect('user/successfulpayment');

    }

}

