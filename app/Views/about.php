
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="damnz.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About damnz Market</title>
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
    <br><br><br><br><br>
    <div class="about-me">
        <div class="about-me-text">
        <h2>Our Story</h2>
        <p>At Damnz Coffee, we are passionate about coffee and believe it's more than just a beverage; it's a way of life, a way to connect, and a way to savor life's simple pleasures. We source the highest quality beans, roast them to perfection, and use only the freshest ingredients. We're committed to providing excellent customer service and creating a warm, welcoming community space where people can gather, share stories, and make a difference. Join us and experience the Damnz Coffee difference.</p>
        </div>
        <img src="foto/us.jpg" alt="me">
    </div>

    <div class="about-container">
        <h1>CURHAT YUKS</h1>
        <p><i class="fa fa-whatsapp"></i> +62 812-9146-9171</p>
        <p><i class="fa fa-envelope"></i> info.damnzcoffee@gmail.com</p>

        <!-- Use the CodeIgniter session helper to get the customer name -->
        <?php if (session()->has('customer_name')) : ?>
            <p><strong>Welcome, <?= session('customer_name'); ?></strong></p>
        <?php endif; ?>
    </div>

    <!-- <script>
        // JavaScript code for "about.html" (username.js)
        window.addEventListener('load', function() {
            setUsername();
        });
    </script> -->
</body>

</html>