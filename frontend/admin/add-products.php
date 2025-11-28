<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
  $type = $_POST['type'];
  $brand = $_POST['brand'];
  $productname = $_POST['productname'];
  $processor = $_POST['processor'];
  $screen = $_POST['screen'];
  $ram = $_POST['ram'];
  $storage = $_POST['storage'];
  $rentalprice = $_POST['rentalprice'];
  $model = $_POST['model'];
  $description = $_POST['description'];

  // Image upload
  $mainimage = $_FILES['mainimage']['name'];
  $extension = substr($mainimage, strlen($mainimage) - 4, strlen($mainimage));
  $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

  if (!in_array($extension, $allowed_extensions)) {
    echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
  } else {
    $newimage = md5($mainimage) . time() . $extension;
    move_uploaded_file($_FILES["mainimage"]["tmp_name"], "images/" . $newimage);

    // Insert query
    $query = mysqli_query($con, "INSERT INTO tblproduct(Type, BrandID, ProductName, Processor, Screen, RAM, Storage, RentalPrice, ProductModel, ProductDescription, Image) 
    VALUES ('$type', '$brand', '$productname', '$processor', '$screen', '$ram', '$storage', '$rentalprice', '$model', '$description', '$newimage')");

    if ($query) {
      echo "<script>alert('Product added successfully');</script>";
      echo "<script>window.location.href='add-products.php'</script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin | Add Product</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Exo', sans-serif;
      background-color: #f5f9ff;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #0d6efd;
      border: none;
      border-radius: 0;
    }
    .navbar-brand, .navbar-nav li a {
      color: white !important;
      font-weight: 600;
    }
    .navbar-brand:hover, .navbar-nav li a:hover {
      color: #dfe8ff !important;
    }

    .container {
      background: white;
      border-radius: 10px;
      padding: 30px 40px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-top: 50px;
    }

    h2 {
      text-align: center;
      font-weight: 700;
      color: #0d6efd;
      margin-bottom: 30px;
    }

    .form-group label {
      font-weight: 600;
    }

    .btn-primary {
      background-color: #0d6efd;
      border: none;
      border-radius: 5px;
      padding: 10px 25px;
      font-size: 16px;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background-color: #094ec3;
    }

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 12px;
      position: fixed;
      bottom: 0;
      width: 100%;
      font-size: 14px;
    }
  </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">ShareNest Admin</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="dashboard.php">Dashboard</a></li>
      <li class="active"><a href="add-products.php">Add Product</a></li>
      <li><a href="manage-products.php">Manage Products</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<!-- MAIN FORM -->
<div class="container">
  <h2>Add New Product</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="type">Product Type</label>
          <select name="type" id="type" class="form-control" required>
            <option value="">Select Type</option>
            <option value="Laptop">Laptop</option>
            <option value="Desktop">Desktop</option>
            <option value="Printer">Printer</option>
          </select>
        </div>

        <div class="form-group">
          <label for="brand">Brand</label>
          <select name="brand" id="brand" class="form-control" required>
            <option value="">Select Brand</option>
            <?php
            $ret = mysqli_query($con, "SELECT * FROM tblbrand");
            while ($row = mysqli_fetch_array($ret)) {
            ?>
              <option value="<?php echo $row['ID']; ?>"><?php echo $row['BrandName']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Product Name</label>
          <input type="text" name="productname" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Processor</label>
          <input type="text" name="processor" class="form-control">
        </div>

        <div class="form-group">
          <label>Screen Size</label>
          <input type="text" name="screen" class="form-control">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>RAM</label>
          <input type="text" name="ram" class="form-control">
        </div>

        <div class="form-group">
          <label>Storage</label>
          <input type="text" name="storage" class="form-control">
        </div>

        <div class="form-group">
          <label>Rental Price (per day)</label>
          <input type="number" name="rentalprice" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Product Model</label>
          <input type="text" name="model" class="form-control">
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="3" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <label>Main Image</label>
          <input type="file" name="mainimage" class="form-control" required>
        </div>
      </div>
    </div>

    <div class="text-center">
      <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
    </div>
  </form>
</div>

<footer>
  © 2025 ShareNest | Admin Panel
</footer>

</body>
</html>
