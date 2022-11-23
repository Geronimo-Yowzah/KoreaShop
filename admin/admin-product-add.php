<?php 
    include "connect.php";
    include "hack.php";
?>

<?php    
    $stmt = $pdo->prepare("SELECT * FROM category");
    $stmt->execute();
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>เพิ่มสินค้า</title>
    <style>
        body {
            font-size: large;
        }
    </style>
</head>
<body>
    <form action="admin-product-add2.php" method="POST">
        ชื่อสินค้า: <input type="text" name="Product_name"><br>
        คำอธิบายสินค้า: <br> <textarea name="Product_Desc" cols="30" rows="3"></textarea><br>
        ราคา: <input type="number" name="Product_price"><br>
        จำนวน: <input type="number" name="Product_quantity"><br>
        หมวดหมู่: <br>
<?php
        while ($category = $stmt->fetch()) {
?>
            <input type="radio" name="Category_ID" value="<?=$category["Category_ID"]?>">
            <?=$category["Category_Name"]?><br>
<?php
        }
?>
        <input type="submit" value="เพิ่มสินค้า">
    </form>
</body>
</html>