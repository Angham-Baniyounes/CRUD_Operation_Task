<?php
    require('connection.php');
    include('header.php');
    include('slider.php');
?>
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <?php
                $query  = "SELECT * FROM category";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-6 col-xl-4 p-b-30 m-lr-auto'>";
                        echo "<div class='block1 wrap-pic-w'>";
                ?>
                    <?php echo  "<img src="."../Admin/".$row['cat_image']." alt='IMG-BANNER' />"; ?>
                    <?php 
                        $catId = $row['cat_id'];
                        echo "<a href='product.php?id=$catId' class='block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3'>";
                        echo "<div class='block1-txt-child1 flex-col-l'>";
                            echo "<span class='block1-name ltext-102 trans-04 p-b-8'>";
                            echo $row['cat_name'];
                            echo "</span>";
                            echo "<span class='block1-info stext-102 trans-04'>";
                            // echo $row['cat_desc'];
                            echo "</span>";
                        echo "</div>";
                        echo "<div class='block1-txt-child2 p-b-4 trans-05'>";
                            echo "<div class='block1-link stext-101 cl0 trans-09'>Shop Now</div>";
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                        echo "</div>";
                    ?>
                <?php };
            ?>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>