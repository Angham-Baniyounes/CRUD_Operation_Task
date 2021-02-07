<?php
    require('includes/connection.php');
    // SELECT `product_id`, `product_name`, `product_desc`, `product_price`, `product_image`,
	if(isset($_POST['submit'])){
		$image_name = $_FILES['product_image']['name'];
        $tmp_name   = $_FILES['product_image']['tmp_name'];
        $path       = 'images/';
        move_uploaded_file($tmp_name, $path.$image_name);

        $product_name  = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_desc  = $_POST['product_desc'];
        $cat_id        = $_POST['category_type'];
        $product_img = $path.$image_name;
		
		$sqlUpdate = "UPDATE product SET 
								product_name   = '$product_name',
								product_price  = '$product_price',
								product_desc   = '$product_desc',
								product_image  = '$product_img',
                                cat_id         = '$cat_id'
								WHERE product_id = {$_GET['id']}";

		mysqli_query($conn, $sqlUpdate);
		header("location:manage_product.php");
	}

	$query  = "SELECT * FROM product WHERE product_id = {$_GET['id']}";
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
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Add Product</strong> 
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="product_name" class=" form-control-label">Product Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="product_name" name="product_name" placeholder="product name" class="form-control" value="<?php echo $row['product_name'] ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="product_price" class=" form-control-label">Product Price</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="product_price" name="product_price" placeholder="product price" class="form-control" value="<?php echo $row['product_price'] ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="product_desc" class=" form-control-label">Product Description</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="product_desc" id="product_desc" rows="9" placeholder="product description..." class="form-control">
                                            <?php echo $row['product_desc'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="product_image" class=" form-control-label">Product Image</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="product_image" name="product_image" class="form-control-file" value="<?php echo $row['product_image'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category-type">Category Type</label>
                                    <select class="form-control" id="category-type" name="category_type">
                                        <?php
                                            $sql = "select * from category";
                                            $result = mysqli_query($conn, $sql);
                                            while($row = mysqli_fetch_assoc($result)) {
                                                $id = $row['cat_id'];
                                                $cat_name = $row['cat_name'];
                                                echo "<option value='$id'>$cat_name</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-dot-circle-o"></i> Add
                                    </button>
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