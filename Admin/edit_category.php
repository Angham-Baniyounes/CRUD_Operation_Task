<?php
require('includes/connection.php');

	if(isset($_POST['submit'])){
		$image_name = $_FILES['cat_image']['name'];
        $tmp_name   = $_FILES['cat_image']['tmp_name'];
        $path       = 'images/';
        move_uploaded_file($tmp_name, $path.$image_name);

        $cat_name  = $_POST['cat_name'];
        $cat_desc  = $_POST['cat_desc'];
        $cat_img = $path.$image_name;
		
		$sqlUpdate = "UPDATE category SET 
								cat_name   = '$cat_name',
								cat_desc   = '$cat_desc',
								cat_image  = '$cat_img'
								WHERE cat_id = {$_GET['id']}";

		mysqli_query($conn, $sqlUpdate);
		header("location:manage_category.php");
	}

	$query  = "SELECT * FROM category WHERE cat_id = {$_GET['id']}";
	$result = mysqli_query($conn,$query);
	$row    = mysqli_fetch_assoc($result);
?>
<?php 
	include('includes/admin_header.php');  
?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Manage Category</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Category</h3>
                            </div>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category name</label>
                                    <input  name="cat_name" type="text" class="form-control" value="<?php echo $row['cat_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category description</label>
                                    <input  name="cat_desc" type="text" class="form-control" value="<?php echo $row['cat_desc'] ?>">
                                </div>
                                <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">Image</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="cat_image" class="form-control-file" value="<?php echo $row['cat_image'] ?>">
                                                </div>
                                            </div>
                                <div>
                                    <button type="submit" class="btn btn-lg btn-info" name="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/admin_footer.php');  ?>