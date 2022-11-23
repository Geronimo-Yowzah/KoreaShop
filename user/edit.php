<?php 
    include "connect.php";
    session_start();
?>

<?php
    $stmt = $pdo->prepare("UPDATE member SET Username=?, Name=?, Gender=?,Address=?, Email=?, Phone=? WHERE Member_ID=?");
    $stmt->bindParam(1, $_POST["Username"]);    
    $stmt->bindParam(2, $_POST["Name"]);
    $stmt->bindParam(3, $_POST["Gender"]);
    $stmt->bindParam(4, $_POST["Address"]);
    $stmt->bindParam(5, $_POST["Email"]);
    $stmt->bindParam(6, $_POST["Phone"]);
    $stmt->bindParam(7, $_POST["Member_ID"]);
    if($stmt->execute()){
        header("location: user-home.php");
    }
?>