<?php
    require('includes/connection.php');
    $sql = "DELETE FROM customer WHERE cust_id = {$_GET['id']}";
    mysqli_query($conn, $sql);
    header("location:manage_customer.php");
?>