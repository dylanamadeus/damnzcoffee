<!-- app/Views/profile.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/profile.css">
</head>

<body>
    <div class="form-container">
        
        <!-- error -->
        <?php if (isset($error)) { ?>
            <div style="color: #f00; margin-bottom: 16px;"><?= $error ?></div>
            <?php } ?>
            
            <!-- success -->
            <?php if (isset($success)) { ?>
                <div style="color: #4caf50; margin-bottom: 16px;"><?= $success ?></div>
                <?php } ?>
                
        <form action="<?= base_url('edit_profile') ?>" method="post" enctype="multipart/form-data">
            <label for="customer_name">Full Name</label>
            <input type="text" id="customer_name" name="customer_name" value="<?= $user['customer_name'] ?>" required>

            <!-- Add new fields based on the customers table -->
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?= $user['address'] ?>" required>

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" value="<?= $user['phone_number'] ?>" required>

            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?= $user['email'] ?>" required>

            <!-- You can add more fields as needed -->

            <button type="submit">Update</button>
            <?php if (session('level') == 1) : ?>
                <a href="<?= base_url('home') ?>">Home</a>
            <?php elseif (session('level') == 2) : ?>
                <a href="<?= base_url('home') ?>">Home</a>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>