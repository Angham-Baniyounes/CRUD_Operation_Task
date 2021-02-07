<?php
    require('includes/connection.php');
    $sql = "DELETE FROM admin WHERE admin_id = {$_GET['id']}";
    mysqli_query($conn, $sql);
    header("location:manage_admin.php");
?>