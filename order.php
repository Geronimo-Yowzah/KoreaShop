<?php 
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'koreashop');    

    foreach ($_SESSION["cart"] as $item => $item1){
        $date = $_GET["date"];
        $orderDate = date('Y-m-d', strtotime($date));
        $net = $_GET["sum"];
        $Pid = $item1['Product_ID'];
        $PqtStore = $item1["qtStore"];
        $PqtTotal = $PqtStore - $item1["qt"];
        $show = $_GET["show"];

        $sql1 = "UPDATE product SET Product_quantity = '$PqtTotal' WHERE Product_ID=$Pid";
        $objQuery1 = mysqli_query($con,$sql1);
    }
    $sql = "INSERT INTO orders(Order_Date,Net) VALUES ($date, $net)";
    $objQuery = mysqli_query($con,$sql);
    $Oid = mysqli_insert_id($con);

    
?>
<div>
<script>
    function send_orderid(){

                var O = document.getElementById("Order").value;
                 
                var url = "clearcart.php?Oid=" +O;
                req.open("GET", url, true);
                req.send(null);
                }
</script>

    <center>
        <p>สั่งซื้อสินค้าสำเร็จ</p>
        <p><?=$show?></p>
        <p>หมายเลขออเดอร์ <?=$Oid?></p>
    </center>
    <center><a href="clearcart.php?Oid=<?=$Oid?>" style="color: green;" onclick='send_orderid()'>จ่ายเงิน</a></center>
    <input type="hidden" id="Order" value="<?=$Oid?>">
</div>