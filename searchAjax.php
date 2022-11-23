<?php
    $keyword = $_GET["keyword"];
    $con = mysqli_connect('localhost', 'root', '', 'koreashop');

    $sql = "SELECT * FROM product WHERE Product_name LIKE '%$keyword%'";
    $objQuery = mysqli_query($con,$sql);
?>
<div class="product">
            <?php while($row = mysqli_fetch_array($objQuery)):?>
                <div class="product-item">
                    <a href="detailproduct.php?Product_ID=<?=$row["Product_ID"]?>">
                        <img id="product-img" src='img/product/<?=$row["Product_ID"]?>.jpg' width="200">    
                    <br>
                   <b>ชื่อสินค้า:</b> <?=$row["Product_name"]?><br>
                   <b>รายละเอียด:</b> <?=$row["Product_Desc"]?><br>
                   <b>ราคา:</b> <?=$row["Product_price"]?><br>
                   </a>
                </div>
            <?php endwhile; ?>
</div>