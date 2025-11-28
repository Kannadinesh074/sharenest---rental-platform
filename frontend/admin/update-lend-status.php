<?php
include('includes/dbconnection.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
  $id = intval($_GET['id']);
  $status = $_GET['status'];

  $query = "UPDATE lendrequests SET status='$status' WHERE id=$id";
  if (mysqli_query($con, $query)) {
    echo "success";
  } else {
    echo "error";
  }
}
?>
