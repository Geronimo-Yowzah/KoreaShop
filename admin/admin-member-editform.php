<?php 
    include "connect.php";
    include "hack.php";
?>

<?php
    $stmt = $pdo->prepare("SELECT * FROM member WHERE Member_ID = ?");
    $stmt->bindParam(1, $_GET["Member_ID"]);
    $stmt->execute();
    $row = $stmt->fetch();
?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <form action="admin-member-edit.php" method="POST">
        <input type="hidden" name="Member_ID" value="<?=$row["Member_ID"]?>"><br>
        ชื่อสมาชิก: <input type="text" name="Name" value="<?=$row["Name"]?>"><br>        
        ชื่อผู้ใช้: <input type="text" name="Username" value="<?=$row["Username"]?>"><br>        
        รหัสผ่าน: <input type="password" name="Password" value="<?=$row["Password"]?>"><br> 
        เพศ: <input type="radio" name="Gender" value="ชาย" required>ชาย
                <input type="radio" name="Gender" value="หญิง" required>หญิง<br>       
        ที่อยู่: <br> <textarea name="Address" cols="30" rows="3"><?=$row["Address"]?></textarea><br>
        อีเมล: <input type="email" name="Email" value="<?=$row["Email"]?>"><br>
        เบอร์โทรศัพท์: <input type="tel" name="Phone" value="<?=$row["Phone"]?>"><br>
        <input type="submit" value="แก้ไขข้อมูล">
    </form>
</body>
</html>