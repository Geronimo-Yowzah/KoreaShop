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
</head>

<?php    

    $stmt2 = $pdo->prepare("SELECT category.Category_Name,category.Category_ID, SUM(product.Product_quantity) AS sum_quantity FROM category 
        JOIN product ON category.Category_ID = product.Category_ID GROUP BY 1");
    $stmt2->execute();

    $stmt = $pdo->prepare("SELECT member.Username, member.Name, COUNT(DISTINCT orders.Order_ID) AS count_order, SUM(DISTINCT orders.Net) AS sum_net FROM buying 
        INNER JOIN orders ON (buying.Order_ID = orders.Order_ID)
        INNER JOIN member ON (buying.Member_ID = member.Member_ID)
        WHERE member.Username = ?");        
    $stmt->bindParam(1, $_SESSION["username"]);
    $stmt->execute();

    
    $row = $stmt->fetch();
    $sum = $row['sum_net'];
    $count = $row['count_order'];

    if($sum >= 3000){
        $rank = "Platinum";
        $claim_rank = '0';       
    } else if($sum >= 2000){
        $rank = "Gold";
        $claim_rank = 3000 - $sum;
    } else if($sum >= 1000){
        $rank = "Sliver";
        $claim_rank = 2000 - $sum;
    } else {
        $rank = "Classic";
        $claim_rank = 1000 - $sum;
    }     
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
                <div><h1>สรุปคำสั่งซื้อ</h1></div>
                <div class="acc1">
                    <div>
                        <b>ชื่อ</b> : <?=$_SESSION["fullname"]?>
                    </div>
                    <div>
                        <b>จำนวนออเดอร์</b> : <?=$count?>
                    </div>                    
                </div>
                <div>
                    <div class="acc-history">
                        <b>ยอดรวมทั้งหมด</b> : <?=$sum?> บาท
                    </div>
                    <div class="acc-history">
                        <b>ระดับ</b> : <?=$rank?> (ต้องซื้อของเพิ่มอีก <?=$claim_rank?> บาท เพื่อเพิ่มระดับ)                        
                        
                    </div>                    
                </div>
                <br>
                
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