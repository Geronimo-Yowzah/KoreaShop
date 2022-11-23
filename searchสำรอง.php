<?php include "connect.php" ?>
<link rel="stylesheet" href="csshome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
<html>
    <head><meta charset="utf8"></head>
    <script>
        var req;
	    function send(){
            req = new XMLHttpRequest();
            req.onreadystatechange = showResult;

            var keyword = document.getElementById("keyword").value;
            var url = "lab12no2.php?keyword=" + keyword;
            req.open("GET", url, true);
            req.send(null);
        }

        function showResult(){
            if(req.readyState == 4 && req.status == 200){
                document.getElementById("result").innerHTML = req.responseText;
            }
        }
    </script>
    <style>
        .product{
            display:grid;
            grid-template-columns: repeat(4,1fr);
            grid-gap: 20px;
            padding: 20px;
            text-align:center;
        }
        form{
            padding: 20px
        }
        #product-img:hover{
            transform: scale(1.02);
        }
        .product-item a:hover{
            color: lightslategray;
        }
        #product-img{
            width: 200px;
            height: 200px;
        }
        .forms{
            display: flex;
            justify-content: center;
        }
    </style>
    <body>
    <div class="warp">
                <ul>
                    <li><a id="login" href="">Login</a></li>
                    <li><a id="register" href="">Register</a></li>
                </ul>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="home.php">หน้าแรก</a></li>
                    <li><a href="category.php">หมวดหมู่</a></li>
                    <li><a href="search.php">ค้นหาสินค้า</a></li>
                    <li><a href="confirm-payment.php">แจ้งชำระเงิน</a></li>
                    <li><a id="cart"href="">ตะกร้าสินค้า</a></li>
                </ul>
            </div>
    <form class="forms">
        <input type="text" name="keyword">
        <input type="submit" value="ค้นหา">
    </form>
    <?php
        $stmt = $pdo->prepare("SELECT * FROM product WHERE Product_name LIKE ? OR Product_Desc LIKE ?");
        if(!empty($_GET))
            $value = '%'.$_GET["keyword"].'%';
        $stmt->bindParam(1,$value);
        $stmt->bindParam(2,$value);
        $stmt->execute();
    ?>
        <div class="product">
            <?php while($row = $stmt->fetch()):?>
                <div class="product-item">
                    <a href="detailproduct.php?Category_ID=<?=$row["Product_ID"]?>">
                        <img id="product-img" src='../minipro/img/product/<?=$row["Product_ID"]?>.jpg' width="200">    
                    <br>
                   <b>ชื่อสินค้า:</b> <?=$row["Product_name"]?><br>
                   <b>รายละเอียด:</b> <?=$row["Product_Desc"]?><br>
                   <b>ราคา:</b> <?=$row["Product_price"]?><br>
                   </a>
                </div>
            <?php endwhile; ?>
        </div>
    </body>
</html>