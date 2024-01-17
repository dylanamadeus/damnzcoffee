<?php
if (!session()->has('isLoggedIn')) {
    return redirect()->to('/login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="damnz.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="username.js"></script>
    <title>Order</title>
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
        </nav>

    <div class="container">
        <main class="grid">
            <?php foreach ($product as $row) : ?>
                <article>
                    <div class="row">
                        <div class="product">
                            <a href="/edit/<?= $row['product_id']; ?>">
                                <img src="<?= base_url('img/' . $row['image']) ?>" alt="<?= $row['product_name'] ?>">
                            </a>
                            <h2><?= $row['product_name'] ?></h2>
                            <p>Rp <?= $row['price'] ?></p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </main>
    </div>
    <script src="confirm_logout.js"></script>
    <script src="username.js"></script>
</body>

</html>