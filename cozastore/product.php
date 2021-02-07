<?php
    require('connection.php');
    include('header.php');
    include('slider.php');
    ?>
<div class="row isotope-grid">
    <?php
        $sql = "SELECT * FROM product WHERE cat_id = {$_GET['id']}";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women'>";
                echo "<div class='block2'>";
                    echo "<div class='block2-pic hov-img0'>";
                        echo "<img src="."../Admin/".$row['product_image']." alt='IMG-PRODUCT'>";
                        echo "<a href='#' class='block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1'>";
                    echo "Quick View";
                echo "</a>";
            echo "</div>";
            echo "<div class='block2-txt flex-w flex-t p-t-14'>";
                echo "<div class='block2-txt-child1 flex-col-l '>";
                    echo "<a href='product-detail.html' class='stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6'>";
                        echo $row['product_name'];
                    echo "</a>";
                    echo "<span class='stext-105 cl3'>";
                        echo "$".$row['product_price'];
                    echo "</span>";
                echo "</div>";
                echo "<div class='block2-txt-child2 flex-r p-t-3'>";
                    echo "<a href='#' class='btn-addwish-b2 dis-block pos-relative js-addwish-b2'>";
                        echo "<img class='icon-heart1 dis-block trans-04' src='images/icons/icon-heart-01.png' alt='ICON'>";
                        echo "<img class='icon-heart2 dis-block trans-04 ab-t-l' src='images/icons/icon-heart-02.png' alt='ICON'>";
                    echo "</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            echo "</div>";
        }
    ?>
</div>
<?php
    include('footer.php');
?>