<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model {
    protected $table = "payment";
    protected $primaryKey = "payment_id";
    protected $protectedFields = true;
    protected $allowedFields = [
        'customer_id', 'payment_method', 'total_payment'
    ];

    public function getPayment($id = false) {
        if($id === false) {
            return $this->findAll();
        } else {
            return $this->where('payment_id', $id)->first();
        }
    }

    public function savePayment($data) {
        return $this->insert($data);
    }

    public function updatePayment($id, $data) {
        return $this->update($id, $data);
    }

    public function deletePayment($id) {
        return $this->delete($id);
    }
}

?>