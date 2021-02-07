<?php
    require('includes/connection.php');
    $sql = "DELETE FROM category WHERE cat_id = {$_GET['id']}";
    mysqli_query($conn, $sql);
    header("location:manage_category.php");
?>