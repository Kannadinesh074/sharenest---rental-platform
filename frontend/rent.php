<?php
// rent.php

// Load products from JSON file
$jsonFile = 'products.json';
$products = [];

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $products = json_decode($jsonData, true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Products</title>
    <link rel="stylesheet" href="style.css"> <!-- keep your existing CSS -->
</head>
<body>
    <?php include 'navbar.php'; ?> <!-- if your project uses a navbar -->

    <div class="container">
        <h1 class="page-title">Rent Products</h1>

        <!-- Display Products -->
        <div class="product-list">
            <?php if (empty($products)): ?>
                <p>No products available for rent.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['description']; ?></p>
                        <strong>Price: ₹<?php echo $product['price']; ?></strong>
                        <br><br>
                        <button class="btn">Rent Now</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .container {
            width: 80%;
            margin: 40px auto;
            font-family: Arial, sans-serif;
        }
        .page-title {
            text-align: center;
            color: #0077cc;
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .product-card {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .btn {
            background-color: #0077cc;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
        }
    </style>
</body>
</html>
