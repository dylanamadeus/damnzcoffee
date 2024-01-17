    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transaction</title>
        <link rel="stylesheet" href="/bayar.css">

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

        <h1>Transaction Details</h1>

        <div class="container">
            <main class="grid">
                <article>
                    <div class="row">
                        <div class="product">
                            <img src="<?= base_url('img/' . $product['image']) ?>" alt="<?= $product['product_name'] ?>">
                            </a>
                            <h2><?= $product['product_name'] ?></h2>
                            <p><?= $product['price'] ?></p>
                        </div>
                    </div>
                </article>
            </main>
        </div>
        <form action="/process_transaction" method="post">
            <input type="number" name="product_id" value="<?= $product['product_id'] ?>" hidden>
            <input type="email" name="email" value="<?= session('email') ?>" hidden>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="<?= isset($trans) ? $trans : '' ?>" required>

            <label for="subtotal">Subtotal:</label>
            <span id="subtotalDisplay"></span><br><br>
            
            <button type="button" onclick="window.location.href='/order'">Cancel</button>
            <button type="submit" id="submitButton">Submit Order</button>
        </form>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const subtotalDisplay = document.getElementById('subtotalDisplay');
            const submitButton = document.getElementById('submitButton');

            quantityInput.addEventListener('change', updateSubtotal);

            function updateSubtotal() {
                const productPrice = <?= $product['price'] ?>;
                const quantity = parseInt(quantityInput.value);

                if (!isNaN(quantity)) {
                    const subtotal = productPrice * quantity;
                    subtotalDisplay.textContent = 'Rp ' + subtotal.toFixed(2);

                } else {
                    subtotalDisplay.textContent = 'Rp 0.00';
                    
                }
            }
        });
    </script>
    </body>

    </html>