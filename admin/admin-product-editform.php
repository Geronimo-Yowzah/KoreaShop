<?php 
    include "connect.php";
    include "hack.php";
?>

<?php
    $stmt = $pdo->prepare("SELECT * FROM product WHERE Product_ID = ?");
    $stmt->bindParam(1, $_GET["Product_ID"]);
    $stmt->execute();
    $product = $stmt->fetch();

    $stmt2 = $pdo->prepare("SELECT * FROM category");
    $stmt2->execute();
    // $category = $stmt->fetch();
?>

<html>
<head>
    <meta charset="utf-8">
    <title>แก้ไขข้อมูล</title>
    <style>
        * {
            font-size: large;
        }
    </style>
</head>
<body>
    <form action="admin-product-edit.php" method="POST">
        <input type="hidden" name="Product_ID" value="<?=$product["Product_ID"]?>"><br>
        ชื่อสินค้า: <input type="text" name="Product_name" value="<?=$product["Product_name"]?>"><br>        
        คำอธิบายสินค้า: <br> <textarea name="Product_Desc" cols="30" rows="3"><?=$product["Product_Desc"]?></textarea><br>
        ราคา: <input type="number" name="Product_price" value="<?=$product["Product_price"]?>"><br>
        จำนวน: <input type="number" name="Product_quantity" value="<?=$product["Product_quantity"]?>"><br>

<?php
        while ($category = $stmt2->fetch()) {
?>            
            หมวดหมู่: <input type="radio" name="Category_ID" value="<?=$category["Category_ID"]?>" required>
            <?=$category["Category_Name"]?><br>
<?php
        }       
?>
        <input type="submit" value="แก้ไขข้อมูล">
    </form>
</body>
</html>