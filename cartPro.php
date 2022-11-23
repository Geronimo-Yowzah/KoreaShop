<?php
    include "connect.php";
    session_start(); 

    // เพิ่มสินค้า
if ($_GET["action"]=="add") {

	$pid = $_GET['Product_ID'];

	$cart_item = array(
 		'Product_ID' => $pid,
		'Product_name' => $_GET['Product_name'],
		'Product_price' => $_GET['Product_price'],
		'qt' => $_POST['qt'],
        'qtStore' => $_GET['qtStore']
	);
    

	// ถ้ายังไม่มีสินค้าใดๆในรถเข็น
	if(empty($_SESSION['cart'])){
    	$_SESSION['cart'] = array();
    }
	// ถ้ามีสินค้านั้นอยู่แล้วให้บวกเพิ่ม
	if(array_key_exists($pid, $_SESSION['cart'])){
		$_SESSION['cart'][$pid]['qt'] += $_POST['qt'];
    }
	// หากยังไม่เคยเลือกสินค้นนั้นจะ
	else{
	    $_SESSION['cart'][$pid] = $cart_item;
    }
        // ปรับปรุงจำนวนสินค้า
    } else if ($_GET["action"]=="update") {
	    $pid = $_GET["Product_ID"];     
	    $qt = $_GET["qt"];
	    $_SESSION['cart'][$pid]['qt'] = $qt;

    // ลบสินค้า
    } else if ($_GET["action"]=="delete") {
	
	    $pid = $_GET['Product_ID'];
	    unset($_SESSION['cart'][$pid]);
    }
?>
<html>
<head>
<script>
    //คลิ้ก+-เพื่ออัพเดตตะกร้า
    function clicka(Product_ID) {
        var qt = document.getElementById(Product_ID).value;
        ++qt;
        document.location = "cartPro.php?action=update&Product_ID=" + Product_ID + "&qt=" + qt;
    }
    function clickd(Product_ID) {
        var qt = document.getElementById(Product_ID).value;
        if(qt > 1){
            --qt;
            document.location = "cartPro.php?action=update&Product_ID=" + Product_ID + "&qt=" + qt;
        }
    }
</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">    
    <link href="sty_home.css" rel="stylesheet"> 
</head>

<style>
    .cartproduct{
        display: inline;
        padding: 20px;
        justify-content:center;
    }
    .setp{
        display: flex;
        padding: 20px;
        justify-content:center;
        align-items: center;
    }
    .pron{
        padding: 10px;
        display: flex;
        align-items: center;
    }
    .proq{
        padding: 10px;
        display: flex;
        align-items: center;
        
    }
    .prom{
        padding: 10px;
        
    }
    .set{
        display:flex;
    }
    .ptotal{
        text-align:right;
        padding-right:150px;
    }
    .Bhome{
        text-align:right;
        padding-right:150px;
    }
    .proq>input{
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
    $stmt2 = $pdo->prepare("SELECT category.Category_Name,category.Category_ID, SUM(product.Product_quantity) FROM category 
    JOIN product ON category.Category_ID = product.Category_ID GROUP BY 1");
    $stmt2->execute();

    $stmt3 = $pdo->prepare("SELECT * FROM product WHERE Product_ID = ?");
    $stmt3->bindParam(1, $_GET["Product_ID"]);
    $stmt3->execute(); 
    $row = $stmt3->fetch();

    
?>

<!-- ไม่มีของในตะกร้าให้แจ้งเตือน -->
<?php if(empty($_SESSION["cart"])){
        echo "<script>
        alert('ไม่มีสินค้าในตะกร้า');
        window.location.href='home.php';
        </script>";      
        }
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
                    <li><a id="register" href="">Register</a></li>
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
                <button class="dropbtn">หมวดหมู่</button>
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
    <!-- รับ modthod post มาแล้วไม่มี session กลับ login -->
<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_SESSION["userlevel"])){
        unset($_SESSION['cart']);
        header("location:login/login.php");
} else {
?>
    <div class="cartproduct">
            <input type="hidden" id="date" value="">
            
            <script>
                let d = new Date();
                let date = d.getDate().toString().padStart(2, "0");
                let m = parseInt(d.getMonth()+1);
                let y = parseInt(d.getFullYear());
                let showdate = y +'' + m +''+date;                
                let show = date + '-' + m + '-' + (y+543);
                console.log(y+543 +'-' + m +'-'+date);
                document.getElementById("date").value = showdate;
            </script>
            <script>
                var req;
	            function send_order(){
                req = new XMLHttpRequest();
                req.onreadystatechange = showResult;

                var D = document.getElementById("date").value;
                var S = document.getElementById("sum").value;
                

                // var PqtStore = document.getElementById("PqtStore").value;
                 
                var url = "order.php?date=" + D + "&sum=" + S + "&show=" + show;
                req.open("GET", url, true);
                req.send(null);
                }

                function showResult(){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById("result").innerHTML = req.responseText;
                }   
            }
            </script>
<?php 
	$sum = 0;
	foreach ($_SESSION["cart"] as $item) {
		$sum += $item["Product_price"] * $item["qt"];
?>
        <div class="setp">
            <div class="set">
                <div class="prom">
                    <img id="img" src='img/product/<?=$item["Product_ID"]?>.jpg' width="200px" height="200px">
                </div>
                <div class="pron">
                    <b><?=$item["Product_name"]?></b>
                </div>
                <div class="proq">
                    <button id="delete" onclick='clickd(<?=$item["Product_ID"]?>)' type="button">-</button>
                    <input type="text" name="numofP" id="<?=$item["Product_ID"]?>" value="<?=$item["qt"]?>"  min="1" size="2" disabled>
                    
                    <input type="hidden" id="Pname" value="<?=$item["Product_name"]?>">
                    <button id="add" onclick='clicka(<?=$item["Product_ID"]?>)' type="button">+</button>
                    <a id="deleteP" href="?action=delete&Product_ID=<?=$item["Product_ID"]?>"><i class="fa-solid fa-trash fa-2x" style="padding:10px; color: red;"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
        <input id="sum" type="hidden" value="<?=$sum?>">
    </div>
            <div class="ptotal">
                รวม <?=$sum?> บาท
            </div>
            <div class="Bhome">
                <button style="background-color: red;color: black;border-radius: 8px;"><a href="home.php">< เลือกสินค้าต่อ</a></button>
                <input id="sub" type="button" style="background-color: green;color: black;border-radius: 8px; margin-left:10px;cursor: pointer;" 
                value="สั่งซื้อ" onclick='send_order()'></input>
            </div>
        <div id="result"></div>


    <footer>
    <h1>Web Development</h1>
        <p>นายจีระพงศ์ แสนโพธิ์ 63-040626-3005-9</p>
        <p>นายฉัตรเพชร ฉัตรปัญญาพร 63-040626-3007-5</p>
        <p>นายพานุพงษ์ ทองเพ็ชร์ 63-040626-3031-8</p>        
        <p>ติดต่อได้ที่:<a href="https://www.facebook.com/stormageddon02" target="_blank"><i class="fa-brands fa-facebook"></i> Geronimo</a></p>

        <?php
            // foreach($_SESSION['cart'] as $item => $item1) {
            //     print_r($item1);
            // }            
        ?>        
    </footer>    
</body>
</html>