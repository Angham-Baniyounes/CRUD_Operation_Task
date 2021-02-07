<?php 
    if(isset($_POST['submit'])){ 
        include_once 'dbConfig.php'; 
        $targetDir = "uploads/"; 
        $allowTypes = array('jpg','png','jpeg','gif');        
        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
        $fileNames = array_filter($_FILES['files']['name']); 

        if(!empty($fileNames)) { 
            foreach($_FILES['files']['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($_FILES['files']['name'][$key]); 
                $targetFilePath = $targetDir . $fileName; 
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 

                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to server 
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                        // Image db insert sql 
                        $insertValuesSQL .= "('".$fileName."', NOW()),"; 
                    }else{ 
                        $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                    } 
                } else{ 
                    $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
                } 
            } 
            
            if(!empty($insertValuesSQL)){ 
                $insertValuesSQL = trim($insertValuesSQL, ','); 
                // Insert image file name into database 
                $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL"); 
                if($insert){ 
                    $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                    $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                    $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                    $statusMsg = "Files are uploaded successfully.".$errorMsg; 
                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file."; 
                } 
            } 
        } else{ 
            $statusMsg = 'Please select a file to upload.'; 
        }        
        // Display status message 
        echo $statusMsg; 
    } 
?>






<section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
    
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <div class="fw-tags">
                            <?php
                            $query  = "SELECT * FROM category";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <a href="category.php?catname=<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></a>
                            <?php
                            };
                            ?>
                        </div>
                    </div>
    
    
                    <div class="filter-widget">
                        <!-- <h4 class="fw-title">Category</h4> -->
                        <div class="recent-blog">
    
                            <?php
                            $query  = "SELECT * FROM category WHERE cat_name='sofas' ";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <a href="shop.php" class="rb-item">
                                    <div class="rb-pic">
                                       <?php echo  "<img src="."../Admin/".$row['cat_image']." width='70%' height='30%'>"?>
                                    </div>
                                </a>
                            <?php
                            };
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <?php
                        $query  = "SELECT * FROM product";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="col-lg-6">
                                <div class="product-pic-zoom">
                                    <img class="product-big-img" src="../Admin/<?php echo $row['product_image']; ?>" alt="">
                                    <div class="zoom-icon">
                                        <i class="fa fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details">
                                    <div class="pd-title">
                                        <h3><?php echo $row['product_name']; ?></h3>
                                    </div>
                                    <div class="pd-desc"><?php echo $row['product_desc']; ?></p>
                                        <h4>$<?php echo $row['product_price']; ?><span></span></h4>
                                    </div>
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                        <button onclick="location.href='carthandler.php?cart_id=<?php echo $row['products_id'] ?>&cart_name=<?php echo $row['products_name'] ?>&cart_price=<?php echo $row['products_price'] ?>'" type="submit" name="Add to Cart" class="primary-btn pd-cart">
                                            Add to cart
                                        </button>
    
                                    </div>
                                </div>
                            </div>
                        <?php
                        };
                        ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>