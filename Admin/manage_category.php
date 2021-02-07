<?php
// INSERT INTO `category`(`cat_id`, `cat_name`, `cat_desc`, `cat_image`) VALUES ([value-1],[value-2],[value-3],[value-4])
    require('includes/connection.php');
    if(isset($_POST['submit'])) {
        $image_name = $_FILES['cat_image']['name'];
        $tmp_name   = $_FILES['cat_image']['tmp_name'];
        $path       = 'images/';
        move_uploaded_file($tmp_name, $path.$image_name);

        $cat_name  = $_POST['cat_name'];
        $cat_desc  = $_POST['cat_desc'];
        $cat_img = $path.$image_name;

        $sql_product = "INSERT INTO category (cat_name, cat_desc, cat_image) VALUES ('$cat_name', '$cat_desc', '$cat_img')";

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
                            <strong>Add Category</strong> 
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="cat_name" class=" form-control-label">Category Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="cat_name" name="cat_name" placeholder="category name" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="cat_desc" class=" form-control-label">Category Description</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="cat_desc" id="cat_desc" rows="9" placeholder="category description..." class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="cat_image" class=" form-control-label">Category Image</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="cat_image" name="cat_image" class="form-control-file">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-dot-circle-o"></i> Add Category
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
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>image</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $get_data = "SELECT * FROM category";
                                        $result = mysqli_query($conn, $get_data);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr class='tr-shadow'>";
                                                echo "<td>{$row['cat_id']}</td>";
                                                echo "<td>{$row['cat_name']}</td>";
                                                echo "<td>{$row['cat_desc']}</td>";
                                                echo "<td><img src='{$row['cat_image']}' width=150 height='50'></td>";
                                                echo "<td>
                                                        <div class='table-data-feature'>
                                                            <a href='edit_category.php?id={$row['cat_id']}'>
                                                                <button class='item' data-toggle='tooltip' data-placement='top' title='Edit' style='background-color: gold;'>
                                                                    <i class='zmdi zmdi-edit'></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>";
                                                    echo "<td>
                                                        <div class='table-data-feature'>
                                                            <a href='delete_category.php?id={$row['cat_id']}'>
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