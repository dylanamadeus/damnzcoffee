<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel as TransModel;
use App\Models\CustModel as Cust;
use App\Models\Product;

class TransactionController extends BaseController
{
    public function save()
    {
        $model = new TransModel();
        $userModel = new Cust();
        $prodMod = new Product();

        $user = $userModel->where('email', session('email'))->first();

        $product = $prodMod->where('product_id', $this->request->getVar('product_id'))->first();
        $total = $product['price'] * $this->request->getPost('quantity');

        $trans = $model->where('customer_id', $user['customer_id'])
            ->where('product_id', $product['product_id'])
            ->where('transaction_id >', $_COOKIE['trans_id'])->first();

        if($this->request->getPost('quantity') > 0){
            if (!empty($trans)) {
                $data = [
                    'product_quantity' => $this->request->getPost('quantity'),
                    'sub_total' => $total,
                ];
                $model->updateTrans($trans['transaction_id'], $data);
            } else {
                $data = [
                    'customer_id' => $user['customer_id'],
                    'product_id' => $this->request->getPost('product_id'),
                    'product_quantity' => $this->request->getPost('quantity'),
                    'sub_total' => $total,
                ];
    
                $model->saveTrans($data);
            }
        }

        $level = $this->request->getPost('level');
        $redirectPage = ($level == 2) ? '/order' : '/order_user';

        return redirect()->to($redirectPage);
    }

    public function delete($id)
    {
        $model = new TransModel();
        $prodMod = new Product();
        $trans = $model->where('transaction_id', $id)->first();
        $product = $prodMod->where('product_id', $trans['product_id'])->first();
        $total = $product['price'] * $this->request->getPost('quantity');
        $data = [
            'product_quantity' => $this->request->getPost('cancelTrans'),
            'sub_total' => $total
        ];
        $model->updateTrans($id, $data);
        return redirect()->to('/payment')->with('success', 'Produk berhasil didelete');
    }
}
