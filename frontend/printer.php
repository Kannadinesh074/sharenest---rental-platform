<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$type = "Printers";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ShareNest | Printers</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Exo', sans-serif;
      background: #f9f9f9;
      color: #333;
    }
    .navbar-custom { background-color: #1abc9c; border: none; border-radius: 0; margin-bottom: 0; }
    .navbar-custom .navbar-brand { color: white !important; font-size: 28px; font-weight: 600; }
    .navbar-custom .navbar-nav > li > a { color: white !important; font-weight: 500; }
    .navbar-custom .navbar-nav > li.active > a { background: rgba(255,255,255,0.2); border-radius: 0; }

    .product-big-title-area { background: #1abc9c; color: white; text-align: center; padding: 40px 0; }
    .product-big-title-area h2 { font-weight: 700; margin-bottom: 10px; }
    .product-big-title-area a.btn { background: white; color: #1abc9c; border-radius: 20px; font-weight: 600; }

    .single-product-area { padding: 60px 0; }
    .single-shop-product {
      background: white; border-radius: 10px; padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05); text-align: center;
      transition: all 0.3s ease; margin-bottom: 40px;
    }
    .single-shop-product:hover { transform: translateY(-5px); box-shadow: 0 6px 16px rgba(0,0,0,0.1); }
    .single-shop-product img { width: 100%; height: 180px; object-fit: contain; margin-bottom: 15px; }
    .single-shop-product h2 { font-size: 20px; color: #111; margin-bottom: 10px; }
    .single-shop-product h2 a { color: #111; text-decoration: none; }
    .single-shop-product h2 a:hover { color: #1abc9c; }
    .product-carousel-price ins { display: block; font-size: 16px; font-weight: 700; color: #1abc9c; margin-bottom: 15px; }
    .product-option-shop a {
      background: #1abc9c; color: white; border-radius: 5px; padding: 8px 20px;
      text-decoration: none; font-weight: 500; display: inline-block; transition: 0.3s ease;
    }
    .product-option-shop a:hover { background: #16a085; }
    footer { background: #1abc9c; color: white; text-align: center; padding: 15px 0; margin-top: 50px; }
  </style>
</head>
<body>
<nav class="navbar navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ShareNest</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">HOME</a></li>
      <li class="active"><a href="rent.php">RENT</a></li>
      <li><a href="lend.php">LEND</a></li>
      <li><a href="about.php">ABOUT</a></li>
      <li><a href="contact.php">CONTACT US</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
      <li><a href="admin/login.php"><span class="glyphicon glyphicon-lock"></span> Admin</a></li>
    </ul>
  </div>
</nav>

<div class="product-big-title-area">
  <div class="container">
    <h2>Printers</h2>
    <a href="rent.php" class="btn btn-default">← Back to All</a>
  </div>
</div>

<div class="single-product-area">
  <div class="container">
    <div class="row">
      <?php
      $query = mysqli_query($con, "SELECT * FROM tblproduct WHERE Type='$type'");
      while ($row = mysqli_fetch_array($query)) {
      ?>
      <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
          <img src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['ProductName'];?>">
          <h2><a href="single-product-details.php?viewid=<?php echo $row['ID'];?>"><?php echo $row['ProductName'];?></a></h2>
          <div class="product-carousel-price">
            <ins><?php echo $row['RentalPrice'];?>/day</ins>
          </div>
          <div class="product-option-shop">
            <a href="single-product-details.php?viewid=<?php echo $row['ID'];?>">More Details</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<footer>
  <p>© 2025 ShareNest | All Rights Reserved</p>
</footer>
</body>
</html>
