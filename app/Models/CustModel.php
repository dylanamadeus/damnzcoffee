<?php
// app/Models/CustModel.php

namespace App\Models;

use CodeIgniter\Model;

class CustModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $allowedFields = ['customer_name', 'address', 'phone_number', 'email', 'password', 'level'];

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    protected $useTimestamps = false;

    public function validateUser(string $email, string $password)
    {
        $user = $this->where('email', $email)->first();

        return $user && password_verify($password, $user['password']);
    }
}
