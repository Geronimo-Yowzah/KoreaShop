<?php 
    include "connect.php";
    session_start();
?>

<?php
    $stmt = $pdo->prepare("UPDATE member SET Password = ? WHERE Member_ID=?");    
    $stmt->bindParam(1, $_POST["Password"]);
    $stmt->bindParam(2, $_POST["Member_ID"]);
    if($stmt->execute()){
        header("location: user-home.php");
    }
?>