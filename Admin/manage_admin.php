<?php 
    require('includes/connection.php');
    if(isset($_POST['submit'])) {
        $admin_fullname     = $_POST['admin_fullname'];
        $admin_email    = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];
        $admin_type = $_POST['admin_type'];

        $sql = "INSERT INTO admin (admin_fullname, admin_email, admin_password, admin_type) VALUES ('$admin_fullname', '$admin_email', '$admin_password', '$admin_type')";

        mysqli_query($conn, $sql);
    }
    include('includes/admin_header.php'); 
?>
    <!-- Start MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <!-- Start Form  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">Create Admin</div>
                            <div class="card-body card-block">
                                <form action="" method="post" class="">
                                    <div class="form-group">
                                        <label for="admin_fullname" class="control-label mb-1">Admin Name :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" id="admin_fullname" name="admin_fullname" placeholder="Full Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_email" class="control-label mb-1">Admin Email :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" id="admin_email" name="admin_email" placeholder="Email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_password" class="control-label mb-1">Password :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                            <input type="password" id="admin_password" name="admin_password" placeholder="Password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_type">Admin Type</label>
                                        <select class="form-control" id="admin_type" name="admin_type">
                                            <option value="superadmin">Super Admin</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" name="submit" class="btn btn-success btn-sm">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form  --> 
                <!-- Start Table  -->
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
                                        <th>email</th>
                                        <th>Type</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $get_data = "SELECT * FROM admin";
                                        $result = mysqli_query($conn, $get_data);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr class='tr-shadow'>";
                                                echo "<td>{$row['admin_id']}</td>";
                                                echo "<td>{$row['admin_fullname']}</td>";
                                                echo "<td>
                                                        <span class='block-email'>{$row['admin_email']}</span>
                                                    </td>";
                                                    echo "<td>{$row['admin_type']}</td>";
                                                echo "<td>
                                                        <div class='table-data-feature'>
                                                            <a href='edit_admin.php?id={$row['admin_id']}'>
                                                                <button class='item' data-toggle='tooltip' data-placement='top' title='Edit' style='background-color: gold;'>
                                                                    <i class='zmdi zmdi-edit'></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>";
                                                    echo "<td>
                                                        <div class='table-data-feature'>
                                                            <a href='delete_admin.php?id={$row['admin_id']}'>
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
            </div>
        </div>
    </div>   
    <!-- End MAIN CONTENT-->     
<?php 
    include('includes/admin_footer.php'); 
?>