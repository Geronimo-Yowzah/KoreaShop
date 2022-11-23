<?php 
    include "connect.php";
    include "hack.php";
?>

<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body{
            margin-top: 2%;
            margin-left: 2%;
        }
    </style>
</head>
<body>
    <h1>List Promotion</h1>
<?php
    $stmt = $pdo->prepare("SELECT product.Product_ID, product.Product_name, product.Product_price, ROUND(discount.Discount_Percent*100.0,0) AS Dis_Percent, ROUND(product.Product_price-(product.Product_price*discount.Discount_Percent),0) AS Dis_price    
    FROM product    
    JOIN discount ON discount.Discount_ID = product.Discount_ID
    HAVING Dis_Percent != 0;");
    $stmt->execute();
?>
    
<?php
    while ($row = $stmt->fetch()) {
?>    
        รหัสสินค้า: <?=$row ["Product_ID"]?><br>
        ชื่อสินค้า: <?=$row ["Product_name"]?><br>
        ราคาเดิม: <?=$row ["Product_price"]?><br>
        ส่วนลด: <?=$row ["Dis_Percent"]?>%<br>
        ราคาโปรโมชัน: <?=$row ["Dis_price"]?><br><hr>
<?php 
    } 
?>       
    <a href="admin-product-list.php" class="btn btn-outline-danger" role="button">ย้อนกลับ</a>
</body>
</html>