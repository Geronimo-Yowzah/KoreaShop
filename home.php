<?php 
    include "connect.php";
    session_start();  
?>

<!DOCTYPE html>
<html>
<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="sty_home.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">    
       
</head>

<?php
    $stmt = $pdo->prepare("SELECT product.Product_ID, product.Product_name, product.Product_price, 
                            ROUND(discount.Discount_Percent*100.0,0) AS Dis_Percent, 
                            ROUND(product.Product_price-(product.Product_price*discount.Discount_Percent),0) AS Dis_price    
                            FROM product    
                            JOIN discount ON discount.Discount_ID = product.Discount_ID;");
    $stmt->execute(); 

    $stmt2 = $pdo->prepare("SELECT category.Category_Name,category.Category_ID, SUM(product.Product_quantity) AS sum_quantity FROM category 
        JOIN product ON category.Category_ID = product.Category_ID GROUP BY 1");
    $stmt2->execute();
?>

<!-- เปลี่ยนloginเป็นชื่อ -->
<body>        
    <header class="top">
    <center>
        
<?php 
        if(empty($_SESSION["username"])){       
?>  
            <div class="warp">       
                <div>
                    <a href="home.php"><img src="img/logo.png" width="150" height="150"></a>
                </div>  
                <ul>
                    <li><a id="login" href="login/login.php">Login</a></li>
                    <li><a id="register" href="register/register.php">Register</a></li>
                </ul>
            </div>  
<?php   }             
        error_reporting(0);          
        if($_SESSION["userlevel"]=="customer"){
?>
            <div class="warp">   
                <div>
                    <a href="home.php"><img src="img/logo.png" width="150" height="150"></a>       
                </div>              
                <ul>
                    <li><div class="dropdown"><a id="login" href=" "><?=$_SESSION["fullname"]?></a>
                        <div class="dropdown-content">
                            <a href="user/user-home.php">บัญชี</a>
                            <a href="login/logout.php">ออกจากระบบ</a>
                        </div>
                    </div></li>
                    <li><a id="cart" href="cartPro.php?action="></a></li>
                </ul>
            </div>        
<?php
        }    
?>
    </center>  
<!-- menu -->
    </header>
    <nav class="menu">
    <table>
            <tr>
                <td><a href="home.php">หน้าแรก</a></td>
                <td><div class="dropdown">
                    <button class="dropbtn">หมวดหมู่</button>
                    <div class="dropdown-content">
<?php
                        while($category = $stmt2->fetch()){
?>
                            <a href="detail.php?Category_ID=<?=$category["Category_ID"]?>"><?=$category["Category_Name"]?> (<?=$category["sum_quantity"]?>)</a>                            
<?php
                        }
?>                        
                    </div>
                </div></td>
                <td><a href="search.php">ค้นหาสินค้า</a></td>
                <td><a href="confirm-payment.php">แจ้งชำระเงิน</a></td>
                <!-- <td></td> -->
            </tr>
        </table>
    </nav>
    <center>
    <section class="product">
<?php 
        while($row = $stmt->fetch()){
?>
            <div class="product-item">
                <a href="detailproduct.php?Product_ID=<?=$row["Product_ID"]?>">
                    <img id="product-img" src='img/product/<?=$row["Product_ID"]?>.jpg' width="200"><br>
                    <b><?=$row["Product_name"]?><br>
                    <?=$row["Dis_price"]?> บาท</b><br>
                </a>
            </div>
<?php 
        } 
?>
    </section>
    </center>
    <footer>
        <h1>Web Development</h1>
        <p>นายจีระพงศ์ แสนโพธิ์ 63-040626-3005-9</p>
        <p>นายฉัตรเพชร ฉัตรปัญญาพร 63-040626-3007-5</p>
        <p>นายพานุพงษ์ ทองเพ็ชร์ 63-040626-3031-8</p>        
        <p>ติดต่อได้ที่:<a href="https://www.facebook.com/stormageddon02" target="_blank"><i class="fa-brands fa-facebook"></i> Geronimo</a></p>
    </footer>
</body>
</html>