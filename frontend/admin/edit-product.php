<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vrmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


$type=$_POST['type'];
$brandid=$_POST['brand'];
$proname=$_POST['proname'];
$screen=$_POST['screen'];
$ram=$_POST['ram'];
$storage=$_POST['storage'];
$charges=$_POST['charges'];
$processor=$_POST['processor'];
$renprice=$_POST['renprice'];
$modyrs=$_POST['modyrs'];
$prodesc=$_POST['prodesc'];
$vid=$_GET['editid'];

 $query=mysqli_query($con,"update tblproduct set Type='$type',BrandID='$brandid',ProductName='$proname',Processor='$processor',Screen='$screen',RAM='$ram',Storage='$storage',Charges='$charges',RentalPrice='$renprice',ProductModel='$modyrs',ProductDescription='$prodesc' where ID='$vid'");

    if ($query) {
   
    echo '<script>alert("Product details has been updated.")</script>';
  }
  else
    {
     echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laptop and Desktop Rental Management Sysytem | Update Products Details</title>
   

    <!-- Style-sheets -->
    <!-- Bootstrap Css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap Css -->
    <!-- Common Css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->
    <!-- Nav Css -->
    <link rel="stylesheet" href="css/style4.css">
    <!--// Nav Css -->
    <!-- Fontawesome Css -->
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!--//web-fonts-->
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
       <?php include_once('includes/sidebar.php');?>

        <!-- Page Content Holder -->
        <div id="content">
            <!-- top-bar -->
       <?php include_once('includes/header.php');?>
            <!--// top-bar -->

            <!-- main-heading -->
            <h2 class="main-title-w3layouts mb-2 text-center"> Update Products Details</h2>
            <!--// main-heading -->

            <!-- Forms content -->
               <section class="forms-section">

               
                <div class="outer-w3-agile mt-3">
                    <h4 class="tittle-w3-agileits mb-4">Update Products Details</h4>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p style="font-size:16px; color:red" align="left"> <?php if($msg){
    echo $msg;
  }  ?> </p>

  <?php
 $vid=$_GET['editid'];
$ret=mysqli_query($con,"select tblproduct.*, tblbrand.ID,tblbrand.BrandName from  tblproduct join tblbrand on tblbrand.ID=tblproduct.BrandID where tblproduct.ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                        <div class="form-row">
                          
                                <div class="form-group col-md-6">
                                <label for="inputEmail4">Type</label>
                                <select class="form-control"  name="type" id="type" required="true">
                                    <option value="<?php echo $row['Type'];?>"> <?php echo $row['Type'];?></option>
                                    <option value="Laptop"> Laptop</option>
                                    <option value="Desktop"> Desktop</option>

                                    </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Brand</label>
                               <select class="form-control" id="brand" name="brand" required="true">
                                <option value="<?php echo $row['BrandID'];?>"><?php echo $row['BrandName'];?></option>
                                        <?php $query1=mysqli_query($con,"select * from tblbrand");
              while($row1=mysqli_fetch_array($query1))
              {
              ?>    
              <option value="<?php echo $row1['ID'];?>"><?php echo $row1['BrandName'];?></option>
                  <?php } ?> 
                                    </select>
                            </div>
                        </div>
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Product Name</label>
                                <input type="text" class="form-control" id="proname" name="proname" required="true" value="<?php echo $row['ProductName'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Processor</label>
                               <input type="text" class="form-control" id="processor" name="processor" required="true" value="<?php echo $row['Processor'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Screen</label>
                                <input type="text" class="form-control" id="screen" name="screen" required="true" value="<?php echo $row['Screen'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Ram</label>
                               <input type="text" class="form-control" id="ram" name="ram" required="true" value="<?php echo $row['RAM'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Storage</label>
                                <input type="text" class="form-control" id="storage" name="storage" required="true" value="<?php echo $row['Storage'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Charges</label>
                               <input type="text" class="form-control" id="charges" name="charges" required="true" value="<?php echo $row['Charges'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Rental Price/Day</label>
                            <input type="text" class="form-control" id="renprice" name="renprice" required="true" value="<?php echo $row['RentalPrice'];?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Product Model</label>
                               <input type="text" class="form-control" id="modyrs" name="modyrs" required="true" value="<?php echo $row['ProductModel'];?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Product Description</label>
                                    <textarea class="form-control" id="prodesc" name="prodesc" rows="3" required="true"><?php echo $row['ProductDescription'];?></textarea>
                                </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">Image</label>
                                <img src="images/<?php echo $row['Image'];?>" width="200" height="150" value="<?php  echo $row['Image'];?>"><a href="changeimage.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Image1</label>
                                <img src="images/<?php echo $row['Image1'];?>" width="200" height="150" value="<?php  echo $row['Image1'];?>"><a href="changeimage1.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Image2</label>
                                <img src="images/<?php echo $row['Image2'];?>" width="200" height="150" value="<?php  echo $row['Image2'];?>"><a href="changeimage2.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">Image3</label>
                                <img src="images/<?php echo $row['Image3'];?>" width="200" height="150" value="<?php  echo $row['Image3'];?>"><a href="changeimage3.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Image4</label>
                                <img src="images/<?php echo $row['Image4'];?>" width="200" height="150" value="<?php  echo $row['Image4'];?>"><a href="changeimage4.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Image5</label>
                                <img src="images/<?php echo $row['Image5'];?>" width="200" height="150" value="<?php  echo $row['Image5'];?>"><a href="changeimage5.php?editid=<?php echo $row['ID'];?>"> &nbsp; Edit</a>
                            </div>
                        </div>
                        <?php } ?>
                       <p style="text-align: center;"><button type="submit" class="btn btn-primary" name="submit">Update</button></p>
                    </form>
                </div>
                <!--// Forms-3 -->
                <!-- Forms-4 -->
               
            </section>

            <!--// Forms content -->

           <?php include_once('includes/footer.php');?>

        </div>
    </div>


    <!-- Required common Js -->
    <script src='js/jquery-2.2.3.min.js'></script>
    <!-- //Required common Js -->

    <!-- Sidebar-nav Js -->
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <!--// Sidebar-nav Js -->

    <!-- Validation Script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';

            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <!--// Validation Script -->

    <!-- dropdown nav -->
    <script>
        $(document).ready(function () {
            $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <!-- //dropdown nav -->

    <!-- Js for bootstrap working-->
    <script src="js/bootstrap.min.js"></script>
    <!-- //Js for bootstrap working -->
</body>
</html>
<?php }  ?>