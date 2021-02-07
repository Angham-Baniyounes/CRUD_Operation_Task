<?php
require('includes/connection.php');
?>

​<?php
if(isset($_POST['submit'])) {
    $targetDir = "images/"; 
    $fileNames = array_filter($_FILES['files']['name']); 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    // echo "<pre>";
    // print_r($fileNames);
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key => $val){  
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir.$fileName; 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)) { 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) { 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."',"; 
                } else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                }
            } else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        }
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO product_images (image_name) VALUES ('$insertValuesSQL')");
            
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    }        
    // Display status message 
    echo $statusMsg; 
    
    die;
}
​?>

<?php
include('includes/admin_header.php');
?>
​
​
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        Select Image Files to Upload:
                        <input type="file" name="files[]" multiple >
                        <input type="submit" name="submit" value="UPLOAD">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

​
​
<?php include('includes/admin_footer.php');  ?>