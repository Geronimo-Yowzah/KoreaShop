<?php 
    include "connect.php";
    include "hack.php";
?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="admin-member-add2.php" method="POST">                
        ชื่อผู้ใช้: <input type="text" name="Username"><br>        
        รหัสผ่าน: <input type="password" name="Password"><br>    
        ชื่อสมาชิก: <input type="text" name="Name"><br>    
        เพศ: <input type="radio" name="Gender" value="ชาย" required>ชาย
                <input type="radio" name="Gender" value="หญิง" required>หญิง<br>    
        ที่อยู่: <br> <textarea name="Address" cols="30" rows="3"></textarea><br>
        อีเมล: <input type="email" name="Email"><br>
        เบอร์โทรศัพท์: <input type="tel" name="Phone" pattern="[0-9]{10}"><br>
        <input type="submit" value="เพิ่มสมาชิก">
    </form>
</body>
</html>