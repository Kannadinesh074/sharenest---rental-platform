<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>shareNest || Home Page</title>
    
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

    <div class="slider-area">
        <div class="zigzag-bottom"></div>
        <div id="slide-list" class="carousel carousel-fade slide" data-ride="carousel">
            <div class="slide-bulletz">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="carousel-indicators slide-indicators">
                                <li data-target="#slide-list" data-slide-to="0" class="active"></li>
                                <li data-target="#slide-list" data-slide-to="1"></li>
                            </ol>                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="single-slide">
                        <div class="slide-bg slide-one"></div>
                        <div class="slide-text-wrapper"></div>
                    </div>
                </div>
                <div class="item">
                    <div class="single-slide">
                        <div class="slide-bg slide-two"></div>
                        <div class="slide-text-wrapper"></div>
                    </div>
                </div>
            </div>
        </div>        
    </div> <!-- End slider area -->
    
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                            <?php
                            // Pagination setup
                            $pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
                            $no_of_records_per_page = 6;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            
                            $ret1 = mysqli_query($con,"SELECT COUNT(*) FROM tblproduct");
                            $total_rows = mysqli_fetch_array($ret1)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            
                            $query = mysqli_query($con,"SELECT * FROM tblproduct LIMIT $offset, $no_of_records_per_page");
                            while ($row = mysqli_fetch_array($query)) {
                                
                                // Rename products dynamically
                                $productName = $row['ProductName'];
                                if (strtolower($productName) == 'desktop') {
                                    $productName = 'Lend';
                                } elseif (strtolower($productName) == 'laptop') {
                                    $productName = 'Rent';
                                }
                            ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="admin/images/<?php echo $row['Image'];?>" width="400" height="200" style="border:solid 1px #000">
                                    <div class="product-hover">
                                        <a href="single-product-details.php?viewid=<?php echo $row['ID'];?>" class="view-details-link">
                                            <i class="fa fa-link"></i> See details
                                        </a>
                                    </div>
                                </div>
                                <h2><a href="single-product-details.php?viewid=<?php echo $row['ID'];?>">
                                    <?php echo $productName; ?>
                                </a></h2>
                                <div class="product-carousel-price">
                                    <ins>$<?php echo $row['RentalPrice']; ?>/day</ins>
                                </div> 
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <h2 class="section-title">Brands</h2>
                        <div class="brand-list">
                            <?php
                            $query = mysqli_query($con,"SELECT * FROM tblbrand");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <img src="admin/images/<?php echo $row['BrandLogo'];?>" alt="" height="200" width="200">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <?php include_once('includes/footer.php');?>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.easing.1.3.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
