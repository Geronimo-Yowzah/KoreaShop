<?php include "connect.php"?>

<html>
<head>
    <meta charset="utf-8">
    <style>
        .mid {
            text-align: center;
            background-color: lightgray;
            margin-left: 20%;
            margin-right: 20%;
            margin-top: 3%;
        }
        .box {
            text-align: center;
            padding: 2%;
            display: inline-block;
        }
        a, a:visited {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <div class="mid">
    <?php
        $stmt = $pdo->prepare("SELECT * FROM member WHERE Role = 'customer'");        
        $stmt->execute();
    ?>

    <?php
        while($row = $stmt->fetch()){
    ?>
            <div class="box">
                <a href="acc-info2.php?Username=<?=$row["Username"]?>">
                    <img src='image/<?=$row["Username"]?>.jpg' width="100" height="120">
                    <br><br><?=$row["Name"]?>
                </a><br>
                
            </div>
    <?php        
        }
    ?>
    </div>
</body>
</html>