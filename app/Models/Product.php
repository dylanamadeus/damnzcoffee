<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model {
    protected $table = "product";
    protected $primaryKey = "product_id";
    protected $protectedFields = true;
    protected $allowedFields = [
        'product_name', 'image', 'price', 'stock'
    ];

    public function getProduct($id = false) {
        if($id === false) {
            return $this->findAll();
        } else {
            return $this->where('product_id', $id)->first();
        }
    }

    public function saveProduct($data) {
        return $this->insert($data);
    }

    public function updateProduct($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteProduct($id) {
        return $this->delete($id);
    }
}

?>