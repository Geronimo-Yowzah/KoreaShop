<?php 
    include "connect.php";
    session_start(); 
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">    
    <link href="sty_home.css" rel="stylesheet"> 
</head>
<script>
    var i = 1;
    function clicka() {
        document.getElementById('num').value = ++i;
    }
    function clickd() {
        if(i > 1){
            document.getElementById('num').value = --i;
        }
    }
</script>
<style>
    .detailProduct{
        display: flex;
        margin:auto;
        margin-top:70px;
        justify-content: center;
        align-items: center;
        width:80%;
        height:700px;
    }
    .img{
        display:flex;
        justify-content: center;
        width:100%;
        height:700px;
        align-items: top;
        padding-top: 20px;
    }
    .descrip{
        display:inline-block;
        justify-content: center;
        text-align: center;
        width:100%;
        height:700px;
    }
    .descrip>b{
        font-size: 22px;
        padding: 15px;
    }
    .name{
        padding:10px;
        font-size: 30px
    }
    .price{
        padding:10px;
        color: red;
        font-size: 25px;
    }
    .des{
        padding:10px;
        font-size: 20px;
    }
    .button{
        padding: 10px;
    }
    button{
        border-radius: 8px;
    }
    #Button{
        background-color: green;
        color: white;
        border-radius: 8px;
        height: 50px;
        width: 180px;
    }
    #Button:hover{
        background-color: lightgreen;
    }
    #num{
        text-align:center;
    }
    #delete:hover{
        background-color: red;
        color: black;
        border-radius: 8px;
    }
    #add:hover{
        background-color: green;
        color: black;
        border-radius: 8px;
    }
</style>

<?php
    $stmt = $pdo->prepare("SELECT product.Product_ID, product.Product_Desc, product.Product_quantity, product.Product_name, product.Product_price, 
                            ROUND(discount.Discount_Percent*100.0,0) AS Dis_Percent, 
                            ROUND(product.Product_price-(product.Product_price*discount.Discount_Percent),0) AS Dis_price    
                            FROM product    
                            JOIN discount ON discount.Discount_ID = product.Discount_ID
                            WHERE product.Product_ID = ?;");
    $stmt->bindParam(1, $_GET["Product_ID"]);                        
    $stmt->execute(); 
    $row = $stmt->fetch();

    $stmt2 = $pdo->prepare("SELECT category.Category_Name,category.Category_ID, SUM(product.Product_quantity) FROM category 
        JOIN product ON category.Category_ID = product.Category_ID GROUP BY 1");
    $stmt2->execute();

    // $stmt3 = $pdo->prepare("SELECT * FROM product WHERE Product_ID = ?");
    // $stmt3->bindParam(1, $_GET["Product_ID"]);
    // $stmt3->execute(); 
    // $row = $stmt3->fetch();
?>


<body>
    <header class="top">
<?php 
        if(empty($_SESSION["username"])){       
?>  
            <div class="warp">       
                <div>
                    <img src="img/logo.png" width="150" height="150">       
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
                    <img src="img/logo.png" width="150" height="150">       
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

    </header>
    <nav class="menu">
    <table>
            <tr>
                <td><a href="home.php">หน้าแรก</a></td>
                <td><div class="dropdown">
                <a href="category.php"><button class="dropbtn">หมวดหมู่</button></a>
                    <div class="dropdown-content">
<?php
                        while($category = $stmt2->fetch()){
?>
                            <a href="detail.php?Category_ID=<?=$category["Category_ID"]?>"><?=$category["Category_Name"]?></a>                            
<?php
                        }
?>                        
                    </div>
                </div></td>
                <td><a href="search.php">ค้นหาสินค้า</a></td>
                <td><a href="confirm-payment.php">แจ้งชำระเงิน</a></td>                
            </tr>
        </table>
    </nav>
    <section class="detailProduct">
        <div class="img">
            <img id="img" src='img/product/<?=$row["Product_ID"]?>.jpg' width="70%" height="70%">
        </div>
        <div class="descrip">
            <div class="name"><b><?=$row["Product_name"]?></b></div>
            <div class="price">฿<?=$row["Dis_price"]?></div>
            <div class="des"><b>Description :</b> <?=$row["Product_Desc"]?></div>
            <form method="post" action="cartPro.php?action=add&Product_ID=<?=$row["Product_ID"]?>&Product_name=<?=$row["Product_name"]?>&Product_price=<?=$row["Dis_price"]?>&qtStore=<?=$row["Product_quantity"]?>">
                <div class="setAP">
                    <button id="delete" onclick="clickd()" type="button">-</button>
                    <input type="text" id="num" name="qt" value="1" size="2" >
                    <button id="add" onclick="clicka()" type="button">+</button>
                </div>
                <div class="button">
                    <input type="submit" id="Button" value="เพิ่มสินค้าลงตะกร้า" style="cursor: pointer;">
                </div>
            </form>
        </div>
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