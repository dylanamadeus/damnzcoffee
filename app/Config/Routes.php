<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::index'); // Halaman login

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->match(['get', 'post'], '/login', 'AuthController::index');
$routes->match(['get', 'post'], '/register', 'AuthController::register');

$routes->get('/home', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/profile', 'AuthController::profile');
$routes->post('/edit_profile', 'AuthController::editProfile');


$routes->get('order', 'Product::index');
$routes->post('order', 'Product::save');
$routes->get('edit/(:num)', 'Product::edit/$1');
$routes->post('edit/(:num)', 'Product::update/$1');
$routes->get('delete/(:num)', 'Product::delete/$1');


$routes->get('placeOrder/(:num)', 'Product::placeOrder/$1');
$routes->post('process_transaction/', 'TransactionController::save');
$routes->get('cancelTransaction/(:num)', 'TransactionController::delete/$1');

if (session()->get('level') == '1') {
    $routes->get('order_user', 'Product::index');
} elseif (session()->get('level') == '2') {
    $routes->get('order_admin', 'Product::index');
}

// Routes.php

// $routes->get('transactions/placeOrder/(:num)', 'TransactionController::placeOrder/$1');

// $routes->group('payment', ['filter' => 'auth'], function ($routes) {
    // $routes->post('processPayment/(:num)', 'PaymentController::processPayment/$1');
    // });
if (session()->get('level') == '1') {
    $routes->get('/payment', 'PaymentController::index');
    $routes->post('/payment', 'PaymentController::save');
} elseif (session()->get('level') == '2') {
    $routes->get('/payment', 'PaymentController::paymentAdmin');
}



$routes->post('/logout', 'AuthController::logout');
$routes->match(['get', 'post'], '/register', 'AuthController::register');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
