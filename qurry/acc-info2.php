<?php include "connect.php"?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        .mid {
            display: flex;
            margin-top: 3%;            
            margin-left: 37%;
        }        
        .text {
            display: inline-block;
            font-size: 130%;
            padding-top: 7%;
            padding-left: 2%;
        }        
    </style>
</head>
<body>    
    <?php        
        $stmt = $pdo->prepare("SELECT member.Username, member.Name, COUNT(DISTINCT orders.Order_ID) AS count_order, SUM(orders.Net) AS sum_net FROM buying 
        INNER JOIN orders ON (buying.Order_ID = orders.Order_ID)
        INNER JOIN member ON (buying.Member_ID = member.Member_ID)
        WHERE member.Username = ?");        
        $stmt->bindParam(1, $_GET["Username"]);
        $stmt->execute();

        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $sum = $row['sum_net'];
        $count = $row['count_order']
    ?>

    <div class="mid">        
        <img src='image/<?=$row["Username"]?>.jpg' width="200" height="200">
        <div class="text">
            ชื่อสมาชิก: <?=$row["Name"]?><br>
            จำนวนออเดอร์: <?=$count?><br>
            ยอดรวมทั้งหมด: <?=$sum?> บาท<br>
        </div>
    </div>
    </div>
</body>
</html>