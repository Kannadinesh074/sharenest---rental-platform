<?php 
session_start(); 
error_reporting(0);  
include('includes/dbconnection.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ShareNest || RENT</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
<?php include_once('includes/header.php');?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>RENT</h2>
            </div>
        </div>

        <!-- 🔽 Product Filter Dropdown -->
        <div class="row" style="margin-top:20px;">
            <div class="col-md-4 col-md-offset-4 text-center">
                <select id="productType" class="form-control" onchange="navigatePage()">
                    <option value="">-- Select Product Type --</option>
                    <option value="laptop.php">Laptops</option>
                    <option value="desktop.php">Desktops</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php  
            // Pagination setup
            if (isset($_GET['pageno'])) { $pageno = $_GET['pageno']; } else { $pageno = 1; }
            $no_of_records_per_page = 8;
            $offset = ($pageno-1) * $no_of_records_per_page;
            $ret1=mysqli_query($con,"select COUNT(*) from tblproduct");
            $total_rows = mysqli_fetch_array($ret1)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);

            $query=mysqli_query($con,"select * from tblproduct LIMIT $offset, $no_of_records_per_page");  
            while ($row=mysqli_fetch_array($query)) {
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img src="admin/images/<?php echo $row['Image'];?>" width="300" height='200' style="border:solid 1px #000">
                    </div>
                    <h2><a href="single-product-details.php?viewid=<?php echo $row['ID'];?>"><?php echo $row['ProductName'];?></a></h2>
                    <div class="product-carousel-price">
                        <ins><?php echo $row['RentalPrice'];?>/day</ins>
                    </div>
                    <div class="product-option-shop">
                        <a class="add_to_cart_button" href="single-product-details.php?viewid=<?php echo $row['ID'];?>">More Details</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <!-- Pagination -->
        <div class="page-pagi text-center">
            <ul class="pagination">
                <li><a href="?pageno=1"><strong>First</strong></a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><strong>Prev</strong></a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><strong>Next</strong></a>
                </li>
                <li><a href="?pageno=<?php echo $total_pages; ?>"><strong>Last</strong></a></li>
            </ul>
        </div>
    </div>
</div>

<?php include_once('includes/footer.php');?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.easing.1.3.min.js"></script>
<script src="js/main.js"></script>

<script>
function navigatePage() {
    var page = document.getElementById("productType").value;
    if (page) {
        window.location.href = page;
    }
}
</script>
</body>
</html>
