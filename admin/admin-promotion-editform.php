<?php 
    include "connect.php";
    include "hack.php";
?>

<?php
    $stmt = $pdo->prepare("SELECT * FROM product WHERE Product_ID = ?");
    $stmt->bindParam(1, $_GET["Product_ID"]);
    $stmt->execute();
    $row = $stmt->fetch();

    $stmt2 = $pdo->prepare("SELECT * FROM discount");
    $stmt2->execute();    
?>

<html>
<head>
    <meta charset="utf-8">
    <title>เพิ่มโปร</title>
    <style>
        * {
            font-size: 110%;
        }
    </style>
</head>
<body>
    <form action="admin-promotion-edit.php" method="POST">
        <input type="hidden" name="Product_ID" value="<?=$row["Product_ID"]?>"><br>
        รหัสสินค้า: <?=$row["Product_ID"]?><br>
         
<?php
        while ($row2 = $stmt2->fetch()) {
?>            
            <input type="radio" name="Discount_ID" value="<?=$row2["Discount_ID"]?>">
            <?=$row2["Discount_Name"]?><br>
    <?php
        }        
    ?>
        <input type="submit" value="เพิ่มโปร">
        
    </form>
</body>
</html>