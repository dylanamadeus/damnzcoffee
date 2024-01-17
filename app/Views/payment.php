<?php if (!session()->has('isLoggedIn')) : ?>
    <?= redirect()->to('/login'); ?>
<?php else : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="damnz.css">
        <script src="username.js"></script>
        <title>User Order</title>
        <style>
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            .popup {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                text-align: center;
            }
        </style>
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

        <br><br><br><br><br><br><br>
        <div class="container">
            <div class="transactionform">
                <?php foreach ($transactions as $transaction) : ?>
                    <?php if ($cekTrans < $transaction) : ?>
                        <?php if ($transaction['product_quantity'] != 0) : ?>
                            <h2>Transaction ID : <?= $transaction['transaction_id']; ?></h2>
                            <div class="underline-transaction"></div>
                            <div class="transaction">
                                <div class="product-info">
                                    <img src="<?= base_url('img/' . $transaction['image']) ?>" alt="<?= $transaction['product_name']; ?>" />
                                    <p><?= $transaction['product_name']; ?></p>
                                    <p>Quantity: <?= $transaction['product_quantity']; ?></p>
                                    <p>Subtotal: Rp. <?= $transaction['sub_total']; ?></p>
                                    <form action="cancelTransaction/<?= $transaction['transaction_id']; ?>">
                                        <input type="text" name="cancelTrans" value="0" hidden>
                                        <button type="submit">Cancel</a></button>
                                    </form>
                                </div>
                            </div>
                            <br>
                        <?php endif; ?>
                    <?php else : ?>
                        <p>Product information not found</p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="total-subtotal">
                <p>Total Subtotal: Rp. <?= $total; ?></p>
                <form id="paymentForm" action="<?= base_url('/payment') ?>" method="post">
                    <select name="method" id="paymentMethod">
                        <option value="Mobile Banking">Mobile Banking</option>
                        <option value="Gopay">Gopay</option>
                        <option value="Dana">Dana</option>
                    </select><br><br>
                    <button type="button" onclick="processPayment()">Process Payment</button>
                </form>
                <div id="overlay" class="overlay">
                    <div id="popup" class="popup">
                        <p id="alert-message"></p>
                    </div>
                </div>

                <div id="alert-container"></div>
            </div>

            <script src="confirm_logout.js"></script>
            <script src="username.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                function placeOrder(productId) {
                    window.location.href = `/transactions/placeOrder/${productId}`;
                }

                function processPayment() {
                    var paymentMethod = document.getElementById('paymentMethod').value;

                    var formData = new FormData();
                    formData.append('method', paymentMethod);

                    // Display SweetAlert loading animation
                    Swal.fire({
                        title: 'Processing Payment',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    var xhr = new XMLHttpRequest();

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            Swal.close(); // Close SweetAlert loading animation

                            if (xhr.status === 200) {
                                window.location.href = '<?= base_url('order_user') ?>';
                                displayAlert('Payment successful!', 'alert-success');
                            } else {
                                console.error('Error processing payment:', xhr.status);
                                displayAlert('Payment failed. Please try again.', 'alert-danger');
                            }
                        }
                    };

                    xhr.open('POST', '<?= base_url('/payment') ?>', true);
                    xhr.send(formData);
                }


                function displayAlert(message, alertType) {
                    var alertElement = document.createElement('div');
                    alertElement.className = 'alert ' + alertType;
                    alertElement.innerHTML = message;

                    var alertContainer = document.getElementById('alert-container');
                    alertContainer.innerHTML = '';
                    alertContainer.appendChild(alertElement);

                    setTimeout(function() {
                        alertContainer.innerHTML = '';
                    }, 5000);
                }



                document.getElementById('overlay').addEventListener('click', function() {
                    document.getElementById('overlay').style.display = 'none';
                });

                document.getElementById('popup').addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent overlay from closing when clicking on the popup
                });
            </script>
    </body>

    </html>
<?php endif; ?>