<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel as TransModel;
use App\Models\CustModel as Cust;
use App\Models\Product;
use App\Models\Payment as Pay;
 
class PaymentController extends BaseController
{
    public function index()
    {
        $userModel = new Cust();
        $model = new TransModel();

        $user = $userModel->where('email', session('email'))->first();

        $cekTrans = $model->where('transaction_id >', $_COOKIE['trans_id'])->findAll();
        // $expirationTime = time() + (10 * 365 * 24 * 60 * 60);
        // $transCookies = $model->orderBy('transaction_id', 'DESC')->first();
        // $cookieValue = ($transCookies !== null && isset($transCookies['transaction_id'])) ? $transCookies['transaction_id'] : 0;

        // setcookie('trans_id', $cookieValue, $expirationTime);
        // setcookie('trans_id', '0', $expirationTime);

        if (!empty($user)) {

            $transtable = $model->select('transaction.*, product.*')
                ->join('product', 'transaction.product_id = product.product_id')
                ->where('customer_id', $user['customer_id'])
                ->where('transaction_id >', $_COOKIE['trans_id'])
                ->findAll();
            $tot_payment = array_sum(array_column($transtable, 'sub_total'));
            $data = [
                'cekTrans' => $cekTrans,
                'transactions' => $transtable,
                'total' => $tot_payment
            ];
            return view('payment', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function save()
    {
        $model = new TransModel();
        $userModel = new Cust();
        $payMod =  new Pay();

        $user = $userModel->where('email', session('email'))->first();

        $transactions = $model->where('customer_id', $user['customer_id'])
            ->where('transaction_id >', $_COOKIE['trans_id'])
            ->findAll();

        $tot_payment = array_sum(array_column($transactions, 'sub_total'));

        $data = [
            'customer_id' => $user['customer_id'],
            'payment_method' => $this->request->getPost('method'),
            'total_payment' => $tot_payment,
        ];

        $payMod->savePayment($data);
        $transCookies = $model->orderBy('transaction_id', 'DESC')->first();
        $expirationTime = time() + (10 * 365 * 24 * 60 * 60);

        setcookie('trans_id', $transCookies['transaction_id'], $expirationTime);

        // Clear the transaction data in the session
        $session = session();
        $session->remove('transactions');
        $session->remove('total');

        return redirect()->to('/');
    }

    public function paymentAdmin()
    {
        $paymentModel = new Pay();

        // Fetch all payments from the database
        $payments = $paymentModel->getPayment();

        // Pass payments data to the view
        $data = [
            'payments' => $payments,
        ];

        // return view('/paymentAdmin', $data);
       return view('paymentAdmin',$data);
    }

    public function processPayment($transactionId)
    {
        return redirect()->to('/payment');
    }
}
