<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model {
    protected $table = "transaction";
    protected $primaryKey = "transaction_id";
    protected $protectedFields = true;
    protected $allowedFields = [
        'customer_id', 'product_id', 'transaction_date', 'product_quantity', 'sub_total'
    ];

    public function getTrans($customerId = null, $transactionId = null)
    {
        if ($customerId !== null && $transactionId === null) {
            return $this->where('customer_id', $customerId)->findAll();
        } elseif ($transactionId !== null) {
            return $this->where('transaction_id', $transactionId)->first();
        } else {
            return $this->findAll();
        }
    }
    

    public function saveTrans($data) {
        return $this->insert($data);
    }

    public function updateTrans($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteTrans($id) {
        return $this->delete($id);
    }
}

?>