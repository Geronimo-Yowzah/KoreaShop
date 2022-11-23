<?php 
    include "connect.php";
    include "hack.php";
?>

<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            margin: 2%;
        }
        a {
            width: 15%;
        }        
        #add {
            float: right;
        }
        #back {
            float: left;
        }
        #mid{
            margin-left: 53em;
        }
        td > a{
            width: 40%;
        } 
    </style>
    <script>
        function confirmDelete(Product_ID) {
            var ans = confirm("ต้องการลบสินค้า" +" "+ Product_ID);
            if(ans == true){
                document.location = "admin-product-delete.php?Product_ID=" + Product_ID;
            }
        }
    </script>
</head>
<body>
    <h1>List Product</h1>    
    
<?php
    $stmt = $pdo->prepare("SELECT * FROM product;");
    $stmt->execute();
?>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ชื่อสินค้า</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ราคา</th>
            <th scope="col">เพิ่มโปรโมชัน</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
        </tr>
        <tbody class="table-group-divider">
    </thead>
<?php
    while ($row = $stmt->fetch() ) {
?>            
            <tr>
                <th scope="row"><?=$row ["Product_ID"]?></th>
                <td><?=$row ["Product_name"]?></td>
                <td><?=$row ["Product_quantity"]?></td>
                <td><?=$row ["Product_price"]?></td>
                <td><a href='admin-promotion-editform.php?Product_ID=<?=$row["Product_ID"]?>' class="btn btn-secondary btn-sm" role="button"><i class="fa-solid fa-plus"></i></a></td>
                <td><a href='admin-product-editform.php?Product_ID=<?=$row["Product_ID"]?>' class="btn btn-warning btn-sm" role="button"><i class="fa-solid fa-pen-to-square"></i></a></td>                
                <td><a href='#' onclick='confirmDelete("<?=$row["Product_ID"]?>")' class="btn btn-danger btn-sm" role="button"><i class="fa-solid fa-trash"></i></a></td>                
            </tr>  
<?php 
    } 
?>      </tbody>
    </table>
    <a href="admin-home.php" class="btn btn-outline-danger" role="button" id="back">ย้อนกลับ</a>
    <a href="promotion.php" class="btn btn-outline-primary" role="button" id="mid">รายละเอียด</a>
    <a href="admin-product-add.php" class="btn btn-outline-primary" role="button" id="add">เพิ่มสินค้า</a>
</body>
</html>



        