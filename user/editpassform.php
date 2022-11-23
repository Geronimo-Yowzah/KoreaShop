<?php 
    include "connect.php";
    session_start();  
?>

<!DOCTYPE html>
<html>
<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บัญชี</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">    
    <link href="../sty_home.css" rel="stylesheet">   
    <link href="sty_user.css" rel="stylesheet">   
    <style>
        input:invalid {
            border-color: red;
        }
    </style>
    <script>
        function show() {
            var x = document.getElementById("newPassword");
            
            if (x.type === "password") {
                x.type = "text";                
            } else {
                x.type = "password";
            }
            
            // var xx = document.getElementById("oldPassword");
            // if (xx.type === "password"){
            //     xx.type = "text";
            // } else {
            //     xx.type = "password";
            // }
        }      
        
    </script>
</head>

<?php
    $stmt = $pdo->prepare("SELECT * FROM member WHERE Member_ID = ?");
    $stmt->bindParam(1, $_SESSION["id"]);
    $stmt->execute();
    $row = $stmt->fetch();

    $stmt2 = $pdo->prepare("SELECT category.Category_Name,category.Category_ID, SUM(product.Product_quantity) AS sum_quantity FROM category 
        JOIN product ON category.Category_ID = product.Category_ID GROUP BY 1");
    $stmt2->execute();

    
?>

<body>        
<header class="top">
<?php 
        if(empty($_SESSION["username"])){       
?>  
            <div class="warp">
                <div>
                    <a href="../home.php"><img src="../img/logo.png" width="150" height="150"></a>       
                </div>
                <ul>
                    <li><a id="login" href="../login/login.php">Login</a></li>
                    <li><a id="register" href="">Register</a></li>
                </ul>
            </div>  
<?php   }             
        error_reporting(0);          
        if($_SESSION["userlevel"]=="customer"){
?>
            <div class="warp"> 
                <div>
                    <a href="../home.php"><img src="../img/logo.png" width="150" height="150"></a>       
                </div>
                <ul>
                    <li><div class="dropdown"><a id="login" href=" "><?=$_SESSION["fullname"]?></a>
                        <div class="dropdown-content">
                            <a href="user/user-home.php">บัญชี</a>
                            <a href="../login/logout.php">ออกจากระบบ</a>
                        </div>
                    </div></li>
                    <li><a id="cart" href="../cartPro.php?action="></a></li>
                </ul>
            </div>        
<?php
        }    
?>
    </header>
    <nav class="menu">
    <table>
            <tr>
                <td><a href="../home.php">หน้าแรก</a></td>
                <td><div class="dropdown">
                    <button class="dropbtn">หมวดหมู่</button>
                    <div class="dropdown-content">
<?php
                        while($category = $stmt2->fetch()){
?>
                            <a href="../detail.php?Category_ID=<?=$category["Category_ID"]?>"><?=$category["Category_Name"]?> (<?=$category["sum_quantity"]?>)</a>                            
<?php
                        }
?>                        
                    </div>
                </div></td>
                <td><a href="../search.php">ค้นหาสินค้า</a></td>
                <td><a href="../confirm-payment.php">แจ้งชำระเงิน</a></td>                
            </tr>
        </table>
    </nav>
    <section class="member-body">
        <aside>
        <div class="member-head">
            <h1>สมาชิก</h1>
        </div>
        <div>
            <div class="member-content">สมาชิก</div>
            <div class="member-menu">
                <div><a href="user-home.php">บัญชี</a></div>
                <div><a href="history.php">สรุปคำสั่งซื้อ</a></div>
                <div><a href="user-order.php">คำสั่งซื้อของฉัน</a></div>
            </div>
            <div class="member-content">การตั้งค่าบัญชี</div>
            <div class="member-menu">
                <div><a href="editform.php">แก้ไขบัญชี</a></div>
                <div><a href="editpassform.php">เปลี่ยนรหัสผ่าน</a></div>
            </div>
        </div>
        </aside>
        <article>
            <div class="content">
                <!-- <div id="errormsg"></div> -->
                <div><h1>เปลี่ยนรหัสผ่านของฉัน</h1></div>
                <div>
                    <form action="editpass.php" method="POST">
                        <input type="hidden" name="Member_ID" value="<?=$row["Member_ID"]?>"><br>                                                             
                        รหัสผ่านใหม่: <input type="password" name="Password" id="newPassword" pattern = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"><br>
                        <i style="font-size: 80%;">ต้องมีอักขระ 8 ตัวขึ้นไปที่มีตัวเลขอย่างน้อยหนึ่งตัว และตัวพิมพ์ใหญ่และตัวพิมพ์เล็กหนึ่งตัว</i><br>
                        <input type="checkbox" onclick="show()"> แสดงรหัสผ่าน <br><br>
                        <input type="submit" value="แก้ไขข้อมูล">
                    </form>
                </div>
            </div>
        </article>
    </section>
    <footer>
        <h1>Web Development</h1>
        <p>นายจีระพงศ์ แสนโพธิ์ 63-040626-3005-9</p>
        <p>นายฉัตรเพชร ฉัตรปัญญาพร 63-040626-3007-5</p>
        <p>นายพานุพงษ์ ทองเพ็ชร์ 63-040626-3031-8</p>        
        <p>ติดต่อได้ที่:<a href="https://www.facebook.com/stormageddon02" target="_blank"><i class="fa-brands fa-facebook"></i> Geronimo</a></p>    
    </footer>
</body>
</html>