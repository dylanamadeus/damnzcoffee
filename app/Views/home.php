<?php if (!session()->has('isLoggedIn')) : ?>
    <?= redirect()->to('/login'); ?>
<?php else : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="home.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="username.js"></script>
        <title>Home Page</title>
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
                    <a href="/payment"><img src="foto/keranjang.png" alt=""></a>
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

        <div class="intro">
            <h1>Our Coffee</h1>
            <p>A Coffee that Everyone Approved The Taste</p>
            <a href="<?= base_url('order') ?>">Order</a>
        </div>

    </body>

    </html>
<?php endif; ?>