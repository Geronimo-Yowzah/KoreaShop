<?php
    include "connect.php";    
    session_start();

    $stmt = $pdo->prepare("SELECT * FROM member WHERE Username = ? AND Password = ?");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]);
    $stmt->execute();
    $row = $stmt->fetch();

    if (!empty($row)) {
        $_SESSION["id"] = $row["Member_ID"];
        $_SESSION["fullname"] = $row["Name"];
        $_SESSION["username"] = $row["Username"];
        $_SESSION["password"] = $row["Password"];
        $_SESSION["gender"] = $row["Gender"];
        $_SESSION["email"] = $row["Email"];
        $_SESSION["address"] = $row["Address"];
        $_SESSION["userlevel"] = $row["Role"];
        setcookie('userlogin',$_POST["username"],time()+ 3600*24);
        setcookie('userpassword',$_POST["password"],time()+ 3600*24);

        if($_SESSION["userlevel"]=="admin"){
            Header("Location: ../admin/admin-home.php");
        }
        // login เสร็จตรวจสอบในตะกร้า มีให้ไปcart เพราะพึ่งสั่ง
        if ($_SESSION["userlevel"]=="customer" && !empty($_SESSION['cart'])){  
            Header("Location: ../cartPro.php?action=");
        }
        else if($_SESSION["userlevel"]=="customer"){
            Header("Location: ../home.php");
        }

    } 
    else{
        echo "<script>
        alert('ชื่อผู้ใช้หรือรหัสผ่าน ผิด!! กรุณากรอกใหม่');
        window.location.href='login.php';
        </script>";
    }      
?>