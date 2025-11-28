<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['vrmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ShareNest | Manage Lending Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS LINKS -->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/style4.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!-- Sidebar -->
        <?php include_once('includes/sidebar.php'); ?>

        <!-- Header -->
        <?php include_once('includes/header.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Manage Lending Products</h3>

                    <div class="table-responsive bs-example widget-shadow">
                        <h4>All Lend Requests:</h4>

                        <?php
                        // Fetch all lend requests
                        $query = "SELECT * FROM lendrequests ORDER BY created_at DESC";
                        $result = mysqli_query($con, $query);

                        if (!$result) {
                            echo "<div class='alert alert-danger'>Error fetching data: " . mysqli_error($con) . "</div>";
                        } elseif (mysqli_num_rows($result) == 0) {
                            echo "<div class='alert alert-info text-center'>No lend requests found.</div>";
                        } else {
                        ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Product Name</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Price (₹)</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo htmlentities($row['username']); ?></td>
                                            <td><?php echo htmlentities($row['product_name']); ?></td>
                                            <td><?php echo htmlentities($row['type']); ?></td>
                                            <td><?php echo htmlentities($row['description']); ?></td>
                                            <td><?php echo htmlentities($row['price']); ?></td>
                                            <td>
                                                <?php if (!empty($row['image'])) { ?>
                                                    <img src="../uploads/<?php echo htmlentities($row['image']); ?>" width="80" height="80" style="border-radius:8px;">
                                                <?php } else { ?>
                                                    <span>No Image</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 'Pending') {
                                                    echo "<span class='label label-warning'>Pending</span>";
                                                } elseif ($row['status'] == 'Approved') {
                                                    echo "<span class='label label-success'>Approved</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>Rejected</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $cnt++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
    </div>

    <!-- JS FILES -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/gnmenu.js"></script>
    <script>
        new gnMenu(document.getElementById('gn-menu'));
    </script>
</body>
</html>
<?php } ?>
