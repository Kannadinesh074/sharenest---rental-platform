<?php
session_start();

// File to store product data
$jsonFile = 'products.json';

// Load existing products
$products = [];
if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $products = json_decode($jsonData, true) ?? [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['productName']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $brand = htmlspecialchars($_POST['brand']);

    // Handle image upload
    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imagePath = $targetFile;
    }

    if (!empty($name) && !empty($description) && !empty($price)) {
        $newProduct = [
            'name' => $name,
            'brand' => $brand,
            'description' => $description,
            'price' => $price,
            'image' => $imagePath
        ];
        $products[] = $newProduct;

        // Save to JSON file
        file_put_contents($jsonFile, json_encode($products, JSON_PRETTY_PRINT));
        header("Location: lend.php"); // refresh the page after save
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShareNest | Lend Product</title>

    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,100" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Page Title -->
<div class="product-big-title-area">
    <div class="container">
        <div class="product-bit-title text-center">
            <h2>Lend Your Product</h2>
        </div>
    </div>
</div>

<!-- Add Product Form -->
<div class="product-form-card" style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.08);max-width:600px;margin:40px auto;">
    <h2 style="font-size:28px;margin-bottom:25px;color:#1abc9c;text-align:center;font-weight:700;">Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="productName" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Brand</label>
            <input type="text" name="brand" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label>Price (₹/day)</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="">Select Type</option>
                <option value="Laptop">Laptop</option>
                <option value="Desktop">Desktop</option>
                <option value="Printer">Printer</option>
            </select>
        </div>

        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success btn-block" style="background:#1abc9c;border:none;">Add Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
