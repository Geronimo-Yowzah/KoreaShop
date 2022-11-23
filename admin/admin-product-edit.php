<?php 
    include "connect.php";
    include "hack.php";
?>

<?php
    $stmt = $pdo->prepare("UPDATE product SET Product_name=?, Product_Desc=?, Product_price=?, Product_quantity=?, Category_ID=? WHERE Product_ID=?");
    $stmt->bindParam(1, $_POST["Product_name"]);
    $stmt->bindParam(2, $_POST["Product_Desc"]);
    $stmt->bindParam(3, $_POST["Product_price"]);
    $stmt->bindParam(4, $_POST["Product_quantity"]);
    $stmt->bindParam(5, $_POST["Category_ID"]);
    $stmt->bindParam(6, $_POST["Product_ID"]);
    if($stmt->execute()){
        echo "แก้ไขข้อมูลสินค้า ". $_POST["Product_ID"]. " สำเร็จ";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>แก้ไขข้อมูล</title>
    
</head>
<body>
    <br>    
    <a href="admin-product-list.php" class="btn btn-outline-danger" role="button">ย้อนกลับ</a>
</body>
</html>