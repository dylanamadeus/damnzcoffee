<?php
// Redirect to home if the user is already logged in
if (session()->has('isLoggedIn')) {
    return redirect()->to('/order');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="damnz.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <div class="login-form">
        <form action="/login" method="post">
            <h1 class="h1login">Account Login</h1>
            <div class="underline-design"></div>
            <br>
            <div class="input-group">
                <label for="email"><img src="foto/user.jpg" alt=""></label>
                <input type="email" id="email" name="email" style="color: black;" placeholder=" Input your email" <?= set_value('email') ?>>
            </div>
            <div class="input-group">
                <label for="password"><img src="foto/pw.jpg" alt=""></label>
                <input type="password" id="password" name="password" placeholder=" Input your password">
            </div>

            <!-- Add the "Remember me" checkbox -->
            <input type="checkbox" id="remember_me" name="remember_me">
            <label for="remember_me">Remember me</label>
            
            <!-- Add the "Light Mode/Dark Mode" checkbox -->
            <!-- <input type="checkbox" id="theme-switch" <?php if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') echo 'checked'; ?>>
            <label for="lightMode">Light Mode</label> -->

            <?php if (session()->has('customer_name')) : ?>
                <!-- Display a welcome message if the user is logged in -->
                <p>Welcome, <?= session('customer_name'); ?>!</p>
            <?php endif; ?>

            <?php if (isset($validation) && $validation->hasError('password', 'validateUser')) : ?>
                <p><?= $validation->getError('password', 'validateUser'); ?></p>
            <?php endif; ?>

            <br><br><br>
            <div class="form-group">
                <button type="submit" name="login">Login</button>
            </div>
            <div class="noaccount-group">
                <p>Don't have an account? <a class="registerPress" href="register">Sign Up Now</a></p>
            </div>
        </form>
    </div>

    <!-- <script>
        const themeSwitch = document.getElementById('theme-switch');
        const body = document.body;

        themeSwitch.addEventListener('change', () => {
            toggleLightMode(themeSwitch.checked);
        });

        // Function to toggle Light mode
        function toggleLightMode(isLightMode) {
            const bgColor = isLightMode ? '#333' : '#f7f7f7';
            const textColor = isLightMode ? '#000' : '#fff';

            body.style.backgroundColor = bgColor;
            body.style.color = textColor;

            // Store the selected theme in a cookie
            const expiryDate = new Date();
            expiryDate.setFullYear(expiryDate.getFullYear() + 1);
            document.cookie = `theme=${isLightMode ? 'light' : 'dark'}; expires=${expiryDate.toUTCString()}`;
        }

        // Check the current theme from cookies and apply it
        const savedTheme = document.cookie.split(';').find(cookie => cookie.trim().startsWith('theme='));
        if (savedTheme) {
            const theme = savedTheme.split('=')[1];
            themeSwitch.checked = theme === 'light';
            toggleLightMode(themeSwitch.checked);
        }
    </script> -->
</body>

</html>