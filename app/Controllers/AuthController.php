<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustModel as UserModel;  

class AuthController extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[32]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password don\'t match'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();
                $user = $model->where('email', $this->request->getVar('email'))->first();

                $remember_me = $this->request->getVar('remember_me');

                if (!empty($remember_me)) {
                    setcookie("remember_me", true, time() + 3600);
                }

                $this->setUserSession($user);

                session()->setFlashdata('success', 'Login Success');

                return redirect()->to('/home');
            }
        } else {
            if (isset($_COOKIE['remember_me'])) {
                return redirect()->to('/home');
            }
        }

        return view('login', $data);
    }


    public function register()
    {
        $data = [];
        helper(['form']);

        if (isset($_COOKIE['remember_me'])) {
            return redirect()->to('/about');
        }

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'customer_name' => 'required|min_length[8]|max_length[50]',
                'address' => 'required|min_length[8]|max_length[50]',
                'phone_number' => 'required|min_length[8]|max_length[15]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[customers.email]',
                'password' => 'required|min_length[8]|max_length[50]',
                'password_confirmation' => 'matches[password]',
                'level' => 'required|in_list[1,2]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();
                $data = [
                    'customer_name' => $this->request->getVar('customer_name'),
                    'address' => $this->request->getVar('address'),
                    'phone_number' => $this->request->getVar('phone_number'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'level' => $this->request->getVar('level'),
                ];
                $model->save($data);
                session()->setFlashdata('success', 'Register Success');
                return redirect()->to('/login'); // Redirect to login page
            }
        }
        return view('signup', $data);
    }

    public function setUserSession($user)
    {
        $data = [
            'customer_name' => $user['customer_name'],
            'email' => $user['email'],
            'isLoggedIn' => true,
            'level' => $user['level'],
        ];
        session()->set($data);
    }

    public function logout()
    {
        setcookie('remember_me', '', time() - 3600);
        setcookie('remember_me', '', time() - 3600);
        session()->remove(['email', 'isLoggedIn']);
        session()->destroy();

        return redirect()->to('login');
    }

    public function profile()
    {
        // Check if the user is logged in
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Instantiate the user model
        $model = new UserModel();

        // Fetch the user's information based on the email stored in the session
        $user = $model->where('email', session('email'))->first();

        // Check if the user was found
        if ($user) {
            // Pass user data to the view
            $data['user'] = $user;

            // Load the 'profile' view
            return view('profile', $data);
        } else {
            // Redirect to login if the user is not found
            return redirect()->to('/login');
        }
    }

    public function editProfile()
    {
        // Check if the user is logged in
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Instantiate the user model
        $model = new UserModel();

        // Fetch the user's information based on the email stored in the session
        $user = $model->where('email', session('email'))->first();

        // Check if the user was found
        if ($user) {
            // If the form is submitted
            if ($this->request->getMethod() == 'post') {
                // Validate the form data
                $rules = [
                    'customer_name' => 'required|min_length[3]|max_length[50]',
                    'address' => 'required|min_length[5]|max_length[50]', // Add validation for other fields
                    'phone_number' => 'required|min_length[8]|max_length[15]',
                    'email' => 'required|valid_email',
                    // Add other validation rules for additional fields
                ];

                if (!$this->validate($rules)) {
                    $data['error'] = $this->validator->getErrors();
                } else {
                    // If validation passes, update the user's profile
                    $updatedData = [
                        'customer_name' => $this->request->getPost('customer_name'),
                        'address' => $this->request->getPost('address'),
                        'phone_number' => $this->request->getPost('phone_number'),
                        'email' => $this->request->getPost('email'),
                        // Add other fields to be updated
                    ];

                    // Update the user's profile in the database
                    $model->update($user['customer_id'], $updatedData);

                    // Redirect to /order
                    return redirect()->to('/order')->with('success', 'Profile updated successfully');
                }
            }

            // Pass user data to the view
            $data['user'] = $user;

            // Load the 'edit_profile' view
            return view('edit_profile', $data);
        } else {
            // Redirect to login if the user is not found
            return redirect()->to('/login');
        }
    }
}
