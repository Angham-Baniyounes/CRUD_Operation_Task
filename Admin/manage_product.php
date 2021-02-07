<?php
    require('includes/connection.php');
    // <!-- product_name	product_desc	product_price	product_image -->
    // image_id	image_name	product_id
    if(isset($_POST['submit'])) {
        $image_name = $_FILES['product_image']['name'];
        $tmp_name   = $_FILES['product_image']['tmp_name'];
        $path       = 'images/';
        move_uploaded_file($tmp_name, $path.$image_name);

        $product_name  = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_desc  = $_POST['product_desc'];
        // $cat_id  = $_POST['cat_id'];
        $cat_id  = $_POST['category_type'];
        $product_img = $path.$image_name;

        $sql_product = "INSERT INTO product (
                                            product_name, 
                                            product_desc, 
                                            product_price, 
                                            product_image,
                                            cat_id
                                            ) VALUES (
                                                        '$product_name', 
                                                        '$product_desc', 
                                                        '$product_price', 
                                                        '$product_img',
                                                        '$cat_id' )";

        mysqli_query($conn, $sql_product);
    }

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
                                        <input type="text" id="product_name" name="product_name" placeholder="product name" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="product_price" class=" form-control-label">Product Price</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="product_price" name="product_price" placeholder="product price" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="product_desc" class=" form-control-label">Product Description</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="product_desc" id="product_desc" rows="9" placeholder="product description..." class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="product_image" class=" form-control-label">Product Image</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="product_image" name="product_image" class="form-control-file">
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
                                    <button type="reset" class="btn btn-danger">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form  -->
            <!-- Start Table -->
            <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <!-- DATA TABLE -->
                        <h3 class="title-5 m-b-35">data table</h3>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>name</th>
                                        <th>price</th>
                                        <th>description</th>
                                        <th>image</th>
                                        <th>category type</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $get_data = "SELECT category.cat_name, 
                                                            product.product_id, 
                                                            product.product_name,
                                                            product.product_desc, 
                                                            product.product_price, 
                                                            product.product_image, 
                                                            product.cat_id 
                                                            FROM product 
                                                    INNER JOIN category ON 
                                                    product.cat_id = category.cat_id";
                                        $result = mysqli_query($conn, $get_data);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr class='tr-shadow'>";
                                                echo "<td>{$row['product_id']}</td>";
                                                echo "<td>{$row['product_name']}</td>";
                                                echo "<td>
                                                        <span class='block-email'>{$row['product_price']}</span>
                                                    </td>";
                                                echo "<td>{$row['product_desc']}</td>";
                                                echo "<td><img src='{$row['product_image']}' width='150' height='50'></td>";
                                                echo "<td>{$row['cat_name']}</td>";
                                                echo "<td>
                                                        <div class='table-data-feature'>
                                                            <a href='edit_product.php?id={$row['product_id']}'>
                                                                <button class='item' data-toggle='tooltip' data-placement='top' title='Edit' style='background-color: gold;'>
                                                                    <i class='zmdi zmdi-edit'></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>";
                                                echo "<td>
                                                    <div class='table-data-feature'>
                                                        <a href='delete_product.php?id={$row['product_id']}'>
                                                            <button class='item' data-toggle='tooltip' data-placement='top' title='Delete' style='background-color: red;'>
                                                                <i class='zmdi zmdi-delete'></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>";
                                            echo "</tr>";
                                            echo "<tr class='spacer'></tr>";
                                        }
                                    ?>                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                    <!-- End Table  -->
                </div> 
            <!-- End row Table -->
        </div>
    </div>
</div>


<?php 
    include('includes/admin_footer.php'); 
?>