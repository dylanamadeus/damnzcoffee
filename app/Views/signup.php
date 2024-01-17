<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <form action="/register" method="post" id="signup" novalidate>
        <div class="startbox">
            <h1>Sign Up</h1>
            <p class="starts">To Starts The Journey</p>
        </div>
        <div class="underline-design"></div>
        <div class="form-group row">
            <label for="name">Name</label> <br>
            <input type="text" id="customer_name" name="customer_name" placeholder="Enter your name">
            <div class="underline"></div>
        </div>
        
        <div class="form-group row">
            <label for="address">Address</label> <br>
            <textarea name="address" id="address" placeholder="Enter your Address"></textarea>
            <div class="underline"></div>
        </div>
        
        <div class="form-group row">
            <label for="phone_number">Phone Number</label><br>
            <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your Phone Number">
            <div class="underline"></div>
        </div>
        
        <div class="form-group row">
            <label for="email">E-mail</label><br>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= set_value('email') ?>">
            <div class="underline"></div>
        </div>
        
        <div class="form-group row">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Enter Password"> 
            <div class="underline"></div>
        </div>
        
        <div class="form-group row">
            <label for="password_confirmation">Confirm Password</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-Enter Password"> 
            <div class="underline"></div>
        </div>

        <input type="text" name="level" value="1" hidden>

        <?php if (isset($validation)) : ?>
            <?= $validation->listErrors() ?>
        <?php endif; ?>

        <div class="form-group row">
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
        <div class="yesaccount-group">
            <p>Already have an account? <a class="loginPress" href="login">Sign in</a></p>
        </div>
    </form>
</body>

</html>

<!-- <script>
    const themeSwitch = document.getElementById('theme-switch');
    const body = document.body;
    const card = document.querySelector('.card');

    themeSwitch.addEventListener('change', () => {
        if (themeSwitch.checked) {
            // Dark Mode
            body.style.backgroundColor = '#333';
            card.style.backgroundColor = 'rgb(80, 90, 50)';
            body.style.color = '#fff';
        } else {
            // Light Mode
            body.style.backgroundColor = '#f7f7f7';
            body.style.color = '#000';
            card.style.backgroundColor = '';
        }

        const expiryDate = new Date();
        expiryDate.setFullYear(expiryDate.getFullYear() + 1);
        document.cookie = `theme=${themeSwitch.checked ? 'dark' : 'light'}; expires=${expiryDate.toUTCString()}`;
    });

    const savedTheme = document.cookie.split(';').find(cookie => cookie.trim().startsWith('theme='));
    if (savedTheme) {
        const theme = savedTheme.split('=')[1];
        themeSwitch.checked = theme === 'dark';
        if (theme === 'dark') {
            body.style.backgroundColor = '#333';
            body.style.color = '#fff';
        }
    }
</script> -->