<?php
require('includes/connection.php');

	if(isset($_POST['submit'])){
		$cust_name      = $_POST['cust_name'];
        $cust_email     = $_POST['cust_email'];
        $cust_mobile    = $_POST['cust_mobile'];
        $cust_address   = $_POST['cust_address'];
        $cust_gender    = $_POST['cust_gender'];
        $cust_password  = $_POST['cust_password'];

		$timpStamp = $_SERVER['REQUEST_TIME'];
        $last_login = date('d-M-Y h:i:s a', $timpStamp);

		$sqlUpdate = "UPDATE customer SET 
								cust_name       = '$cust_name', 
                                cust_email      = '$cust_email', 
                                cust_mobile     = '$cust_mobile', 
                                cust_address    = '$cust_address', 
                                cust_gender     = '$cust_gender', 
                                cust_password   = '$cust_password', 
                                last_login      = '$last_login'
								WHERE cust_id   = {$_GET['id']}";

		mysqli_query($conn, $sqlUpdate);
		header("location:manage_customer.php");
	}
	$query  = "select * from customer where cust_id = {$_GET['id']}";
	$result = mysqli_query($conn, $query);
	$row    = mysqli_fetch_assoc($result);
?>
<?php 
	include('includes/admin_header.php');  
?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <!-- Start Form  -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">Create Customer</div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="">
                                <div class="form-group">
                                    <label for="cust_name" class="control-label mb-1">Customer Name :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="cust_name" name="cust_name" placeholder="Customer Name" class="form-control" value="<?php echo $row['cust_name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cust_email" class="control-label mb-1">Customer Email :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="email" id="cust_email" name="cust_email" placeholder="Email" class="form-control" value="<?php echo $row['cust_email'] ?>">
                                    </div>
                                </div>
                                <!-- cust_mobile -->
                                <div class="form-group">
                                    <label for="cust_mobile" class="control-label mb-1">Admin Mobile :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-mobile"></i>
                                        </div>
                                        <input type="tel" id="cust_mobile" name="cust_mobile" placeholder="077--------" class="form-control" value="<?php echo $row['cust_mobile'] ?>">
                                    </div>
                                </div>
                                <!-- cust_address  -->
                                <div class="form-group">
                                    <label for="cust_address" class="control-label mb-1">Customer Address :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <input type="text" id="cust_address" name="cust_address" placeholder="Address...." class="form-control" value="<?php echo $row['cust_address'] ?>">
                                    </div>
                                </div>
                                <!-- cust_gender  -->
                                <div class="form-group">
                                    <label for="name">Gender :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon col-12">
                                            <i class="fas fa-male"></i>
                                            <input type="radio" id="male" name="cust_gender" value="male" value="<?php echo $row['cust_gender'] ?>">
                                            <label for="male">Male</label> 
                                            <i class="fas fa-female"></i>
                                            <input type="radio" id="female" name="cust_gender" value="female" value="<?php echo $row['cust_gender'] ?>">
                                            <label for="female">Female</label><br>
                                        </div>
                                    </div>
                                </div>
                                <!-- cust_password	 -->
                                <div class="form-group">
                                    <label for="cust_password" class="control-label mb-1">Password :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk"></i>
                                        </div>
                                        <input type="password" id="cust_password" name="cust_password" placeholder="Password" class="form-control" value="<?php echo $row['cust_password'] ?>">
                                    </div>
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form  --> 
        </div>
    </div>
</div>    
<?php 
    include('includes/admin_footer.php'); 
?>