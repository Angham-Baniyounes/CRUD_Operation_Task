<?php
require('includes/connection.php');

	if(isset($_POST['submit'])){
		$fullname = $_POST['admin_fullname'];
		$email    = $_POST['admin_email'];
		$password = $_POST['admin_password'];
		$type = $_POST['admin_type'];
		
		$sqlUpdate = "UPDATE admin SET 
								admin_fullname  = '$fullname',
								admin_email 	= '$email',
								admin_password  = '$password',
								admin_type 		= '$type'
								WHERE admin_id  = {$_GET['id']}";

		mysqli_query($conn, $sqlUpdate);
		header("location:manage_admin.php");
	}

	$query  = "select * from admin where admin_id = {$_GET['id']}";
	$result = mysqli_query($conn,$query);
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
                        <div class="card-header">Update Admin Account</div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="">
                                <div class="form-group">
                                    <label for="admin_fullname" class="control-label mb-1">Admin Name :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="admin_fullname" name="admin_fullname" placeholder="Full Name" class="form-control" value="<?php echo $row['admin_fullname'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="admin_email" class="control-label mb-1">Admin Email :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input type="email" id="admin_email" name="admin_email" placeholder="Email" class="form-control" value="<?php echo $row['admin_email'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="admin_password" class="control-label mb-1">Password :</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk"></i>
                                        </div>
                                        <input type="password" id="admin_password" name="admin_password" placeholder="Password" class="form-control" value="<?php echo $row['admin_password'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="admin_type">Admin Type</label>
                                    <select class="form-control" id="admin_type" name="admin_type" value="<?php echo $row['admin_type'] ?>">
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" name="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/admin_footer.php');  ?>