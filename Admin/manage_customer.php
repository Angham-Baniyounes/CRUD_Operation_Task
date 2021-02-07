<?php
// cust_id	cust_name	cust_email	cust_mobile	cust_address	cust_gender	cust_password	last_login
    require('includes/connection.php');
    if(isset($_POST['submit'])) {
        $cust_name      = $_POST['cust_name'];
        $cust_email    = $_POST['cust_email'];
        $cust_mobile    = $_POST['cust_mobile'];
        $cust_address   = $_POST['cust_address'];
        $cust_gender    = $_POST['cust_gender'];
        $cust_password  = $_POST['cust_password'];
        // $last_login  = $_POST['last_login'];

        $timpStamp = $_SERVER['REQUEST_TIME'];
        $last_login = date('d-M-Y h:i:s a', $timpStamp);

        $sql_customer = "INSERT INTO customer (
                                                cust_name, 
                                                cust_email, 
                                                cust_mobile, 
                                                cust_address, 
                                                cust_gender, 
                                                cust_password, 
                                                last_login
                                                ) VALUES ( 
                                                            '$cust_name', 
                                                            '$cust_email', 
                                                            '$cust_mobile', 
                                                            '$cust_address', 
                                                            '$cust_gender', 
                                                            '$cust_password', 
                                                            '$last_login'
                                                        )";

        mysqli_query($conn, $sql_customer);
    }
?>

<?php 
    include('includes/admin_header.php'); 
?>
<!-- Start MAIN CONTENT-->
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
                                            <input type="text" id="cust_name" name="cust_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cust_email" class="control-label mb-1">Customer Email :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <input type="email" id="cust_email" name="cust_email" class="form-control">
                                        </div>
                                    </div>
                                    <!-- cust_mobile -->
                                    <div class="form-group">
                                        <label for="cust_mobile" class="control-label mb-1">Customer Mobile :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fas fa-mobile"></i>
                                            </div>
                                            <input type="tel" id="cust_mobile" name="cust_mobile" class="form-control">
                                        </div>
                                    </div>
                                    <!-- cust_address  -->
                                    <div class="form-group">
                                        <label for="cust_address" class="control-label mb-1">Customer Address :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <input type="text" id="cust_address" name="cust_address" class="form-control">
                                        </div>
                                    </div>
                                    <!-- cust_gender  -->
                                    <div class="form-group">
                                        <label for="name">Gender :</label>
                                        <div class="input-group">
                                            <div class="input-group-addon col-12">
                                                <i class="fas fa-male"></i>
                                                <input type="radio" id="male" name="cust_gender" value="male">
                                                <label for="male">Male</label> 
                                                <i class="fas fa-female"></i>
                                                <input type="radio" id="female" name="cust_gender" value="female">
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
                                            <input type="password" id="cust_password" name="cust_password" class="form-control">
                                        </div>
                                    </div>
                                    <!-- last_login -->
                                    <!-- <div class="form-group">
                                        <label for="admin_type">Last Login</label>
                                        <input type="datetime-local" name="last_login" id="">
                                    </div> -->
                                    <div class="form-actions form-group">
                                        <button type="submit" name="submit" class="btn btn-success">Add</button>
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
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Last Login</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $get_data = "SELECT * FROM customer";
                                        $result = mysqli_query($conn, $get_data);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr class='tr-shadow'>";
                                                echo "<td>{$row['cust_id']}</td>";
                                                echo "<td>{$row['cust_name']}</td>";
                                                echo "<td>
                                                        <span class='block-email'>{$row['cust_email']}</span>
                                                    </td>";
                                                echo "<td>{$row['cust_mobile']}</td>";
                                                echo "<td>{$row['cust_address']}</td>";
                                                echo "<td>{$row['cust_gender']}</td>";
                                                echo "<td>{$row['last_login']}</td>";
                                                echo "<td>
                                                        <div class='table-data-feature'>
                                                            <a href='edit_customer.php?id={$row['cust_id']}'>
                                                                <button class='item' data-toggle='tooltip' data-placement='top' title='Edit' style='background-color: gold;'>
                                                                    <i class='zmdi zmdi-edit'></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>";
                                                    echo "<td>
                                                        <div class='table-data-feature'>
                                                            <a href='delete_customer.php?id={$row['cust_id']}'>
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