<?php include "connect.php" ?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        table{
            font-size: 120%;
            text-align: center;
            margin: 3%;  
            width: 40%;          
        }        
        h1{
            margin-top: 2%;
            text-indent: 1em;
        }
    </style>
</head>
<body>
    <h1>สรุปคำสั่งซื้อ</h1>
<?php
    $stmt = $pdo->prepare("SELECT orders.Order_ID, member.Name, orders.Order_Date, orders.Net FROM buying
    INNER JOIN orders ON (orders.Order_ID = buying.Order_ID)
    INNER JOIN member ON (member.Member_ID = buying.Member_ID)
    GROUP BY 1;");
    $stmt->execute();
?>
    <table border="1">
        <th>ออเดอร์</th>
        <th>ชื่อสมาชิก</th>
        <th>วันที่สั่ง</th>
        <th>ยอดที่ต้องชำระ</th>        
<?php
    while ($row = $stmt->fetch()) {
?>
        <tr>
            <td><?=$row ["Order_ID"]?></td>
            <td><?=$row ["Name"]?></td>
            <td><?=$row ["Order_Date"]?></td>
            <td><?=$row ["Net"]?> บาท</td>            
        </tr>        
<?php 
    } 
?>
    </table>
    <a href="payment.php">คลิ๊กที่นี่ เพื่อชำระเงิน</a>
</body>
</html>