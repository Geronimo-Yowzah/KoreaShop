<?php 
    include "connect.php";
    include "hack.php";
?>

<?php
    $stmt = $pdo->prepare("INSERT INTO member VALUES('',?,?,?,?,?,?,?,'customer')");    
    $stmt->bindParam(1, $_POST["Username"]);
    $stmt->bindParam(2, $_POST["Password"]);
    $stmt->bindParam(3, $_POST["Name"]);
    $stmt->bindParam(4, $_POST["Gender"]);
    $stmt->bindParam(5, $_POST["Address"]);
    $stmt->bindParam(6, $_POST["Email"]);
    $stmt->bindParam(7, $_POST["Phone"]);
    $stmt->execute();
?>

<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">    
</head>
<body>
    เพิ่มสินค้าสำเร็จ<br><br><br>    
    <a href="admin-member-list.php" class="btn btn-outline-primary" role="button">ย้อนกลับ</a>
</body>
</html>