<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="damnz.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="username.js"></script>
    <link rel="stylesheet" href="/payAdmin.css">
    <title>Payment Admin</title>
</head>

<body>
    <nav>
        <div>
            <a href="<?= base_url('home') ?>"><img src="foto/logo1.png" alt=""></a>
        </div>
        <ul>
            <li>
                <a href="<?= base_url('home') ?>">Home</a>
            </li>
            <li>
                <a href="<?= base_url('order') ?>">Order</a>
            </li>
            <li>
                <a href="<?= base_url('about') ?>">About</a>
            </li>
            <li>
                <a href="<?= base_url('paymentAdmin') ?>"><img src="foto/keranjang.png" alt=""></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?= base_url('profile') ?>" role="button" aria-expanded="false">
                    <img src="foto/profile.png" alt="">
                </a>
                <ul class="dropdown-menu dropdown-content">
                    <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                    <li><a class="dropdown-item" href="/logout" onclick="confirmLogout()">Logout</a></li>
                </ul>
            </li>
            <li>
                <a class="customer-name" id="username-placeholder" href="<?= base_url('profile') ?>">
                    Welcome, <?= session()->has('customer_name') ? session('customer_name') : 'Guest'; ?>
                    (<?= session()->has('level') ? (session('level') == 2 ? 'Admin' : 'User') : 'Guest'; ?>)
                </a>

            </li>

        </ul>
    </nav><br><br><br><br>

    <h1><span>CUSTOMER PAYMENT DATA</span></h1>
    <h2></h2>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Customer ID</th>
                    <th>Payment Method</th>
                    <th>Total Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment) : ?>
                    <tr>
                        <td><?= $payment['payment_id']; ?></td>
                        <td><?= $payment['customer_id']; ?></td>
                        <td><?= $payment['payment_method']; ?></td>
                        <td><?= $payment['total_payment']; ?></td>
                        <!-- Add more columns if needed... -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Include your scripts... -->
</body>

</html>