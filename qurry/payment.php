<?php include "connect.php" ?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            font-size: 120%;
            text-align: center;
            margin: 3%;
            width: 40%;
        }
        h1, h2{
            margin-top: 2%;
            text-indent: 1em;
        }
        form {
            text-indent: 3.5em;
        }
    </style>
</head>
<body>
    <h1>การชำระเงิน</h1>
<?php
    $stmt = $pdo->prepare("SELECT confirm_order.Slip_ID, confirm_order.Order_ID, member.Name, slip.Date, slip.Time, confirm_order.Status FROM slip 
    INNER JOIN confirm_order ON (slip.Slip_ID = confirm_order.Slip_ID)
    INNER JOIN member ON (slip.Member_ID = member.Member_ID)
    ORDER BY 1;");
    $stmt->execute();

    
?>
    <table border="1">
        <th>สลิป</th>
        <th>ออเดอร์</th>
        <th>ชื่อสมาชิก</th>
        <th>วันที่</th>
        <th>เวลา</th>
        <th>สถานะ</th>
<?php
    while ($row = $stmt->fetch()) {
?>
        <tr>
            <td><?=$row ["Slip_ID"]?></td>
            <td><?=$row ["Order_ID"]?></td>
            <td><?=$row ["Name"]?></td>
            <td><?=$row ["Date"]?></td>
            <td><?=$row ["Time"]?></td>
            <td><?=$row ["Status"]?></td>
        </tr>        
<?php 
    } 
?>
    </table>
    <br><br><br><br><br><br><br><br><br>
    <h2>จ่ายเงิน</h2>
    <form action="">
        ส่งสลิป : <input type="file">
    </form>
</body>
</html>