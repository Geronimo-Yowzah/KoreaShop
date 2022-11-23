<?php 
    include "connect.php";
    include "hack.php";
?>

<?php
    $stmt = $pdo->prepare("UPDATE product SET Discount_ID=? WHERE Product_ID=?");
    $stmt->bindParam(1, $_POST["Discount_ID"]);  
    $stmt->bindParam(2, $_POST["Product_ID"]);  
    if($stmt->execute()){
        header("location: admin-product-list.php");
    }    
?>