<?php
    require('includes/connection.php');
    $sql = "DELETE FROM product WHERE product_id = {$_GET['id']}";
    mysqli_query($conn, $sql);
    header("location:manage_product.php");
?>