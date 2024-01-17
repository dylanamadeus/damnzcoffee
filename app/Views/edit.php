<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/edit.css">        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <style>
        .form-container {
            background-image: url('<?= base_url('img/' . $product['image']) ?>');
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="/edit/<?= $product['product_id'] ?>" method="post">
            <p>Products Name : <input type="text" name="product_name" value="<?= $product['product_name'] ?>"></p>
            <p>Image Source : <input type="text" name="image" value="<?= $product['image'] ?>"></p>
            <p>Price : <input type="text" name="price" value="<?= $product['price'] ?>"></p>
            <button type="submit">Update</button>
            <a href="/order">Cancel</a>
            <a href="/delete/<?= $product["product_id"]; ?>">
                <img src="<?= base_url('icon/trash.svg'); ?>" alt="Delete" width="20" height="15">
            </a>
        </form>
    </div>
</body>
</html>