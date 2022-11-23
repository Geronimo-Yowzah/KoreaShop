<?php
    include "connect.php";    
    session_start();

    foreach ($_SESSION["cart"] as $item => $item1){
    $Pid = $item1['Product_ID'];
    $Oid = $_GET['Oid'];
    $insert = $pdo->prepare("INSERT INTO buying VALUES (?,?,?,?)");
    $insert->bindParam(1, $Pid);
    $insert->bindParam(2, $Oid);
    $insert->bindParam(3, $_SESSION["id"]);
    $insert->bindParam(4, $item1["qt"]);
    $insert->execute();
    }

    if($_SESSION['cart']){
        unset($_SESSION['cart']);
        Header("Location: confirm-payment.php");
    }
?>

