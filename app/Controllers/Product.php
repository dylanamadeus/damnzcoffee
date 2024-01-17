<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product as ProductModel;
use App\Models\TransactionModel as Trans;
use App\Models\CustModel as Cust;

class Product extends BaseController
{
    private function isUserAdmin()
    {
        return session()->get('level') == '2';
    }

    public function index()
    {
        $model = new ProductModel();
        $data = [
            'product' => $model->getProduct(),
            'userLevel' => session()->has('level') ? session('level') : null,
        ];

        if ($this->isUserAdmin()) {
            return view('/order', $data); // Admin view
        } else {
            return view('/order_user', $data); // User view
        }
    }

    public function save()
    {
        $model = new ProductModel();
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'image' => $this->request->getPost('image'),
            'price' => $this->request->getPost('price'),
        ];
        $model->saveProduct($data);
        $level = $this->request->getPost('level');

        $redirectPage = ($level == 2) ? '/order' : '/order_user';

        return redirect()->to($redirectPage);
    }

    public function edit($id)
    {
        $model = new ProductModel();
        $data = [
            'product' => $model->getProduct($id),
        ];
        return view('edit', $data);
    }

    public function update($id)
    {
        $model = new ProductModel();

        // Pastikan pengguna adalah admin sebelum mengizinkan update
        if (session()->get('level') != '2') {
            // Jika bukan admin, kembalikan respon yang sesuai (misalnya, status 403 Forbidden)
            return redirect()->to('/order')->with('error', 'Anda tidak diizinkan melakukan update');
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'image' => $this->request->getPost('image'),
            'price' => $this->request->getPost('price'),
        ];
        $model->updateProduct($id, $data);
        return redirect()->to('/order')->with('success', 'Produk berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new ProductModel();

        // Pastikan pengguna adalah admin sebelum mengizinkan delete
        if (session()->get('level') != '2') {
            // Jika bukan admin, kembalikan respon yang sesuai (misalnya, status 403 Forbidden)
            return redirect()->to('/order')->with('error', 'Anda tidak diizinkan melakukan delete');
        }

        try {
            $model->deleteProduct($id);
            return redirect()->to('/order')->with('success', 'Produk berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->to('/order')->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    public function placeOrder($productId)
    {
        $model = new ProductModel();
        $userModel = new Cust();
        $inTrans = new Trans();
    
        $user = $userModel->where('email', session('email'))->first();
        $trans = $inTrans->where('customer_id', $user['customer_id'])
                ->where('product_id', $productId)
                ->where('transaction_id >', $_COOKIE['trans_id'])->first();
        $product = $model->getProduct($productId);
    
        $data = [
            'trans' => !empty($trans) ? $trans['product_quantity'] : null,
            'product' => $product,
        ];
    
        return view('transaksi', $data);
    }
    
    public function payment()
    {
        return view('payment');
    }
}
