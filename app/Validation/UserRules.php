<?php

namespace App\Validation;
use App\Models\CustModel;

class UserRules
{
    public function validateUser(String $str, string $fields, array $data)
    {
        $model = new CustModel();
        $user = $model->where('email', $data['email'])->first();
        if(!$user)
            return false;
        return password_verify($data['password'], $user['password']);
    }
}

?>