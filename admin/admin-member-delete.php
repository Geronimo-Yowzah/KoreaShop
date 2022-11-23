<?php 
    include "connect.php";
    include "hack.php";
?>

<?php
    $stmt = $pdo->prepare("DELETE FROM member WHERE Member_ID=?");
    $stmt->bindParam(1, $_GET["Member_ID"]);
    if($stmt->execute()){
        header("location: admin-member-list.php");
    }
?>