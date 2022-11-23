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
            width: 60%;
        } 
    </style>
    <script>
        function confirmDelete(Member_ID) {
            var ans = confirm("ต้องการลบสมาชิก" +" "+ Member_ID);
            if(ans == true){
                document.location = "admin-member-delete.php?Member_ID=" + Member_ID;
            }
        }
    </script>
</head>
<body>
    <h1>List Member</h1>    
    
<?php
    $stmt = $pdo->prepare("SELECT * FROM member WHERE Role = 'customer';");
    $stmt->execute();
?>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ชื่อสมาชิก</th>
            <th scope="col">ชื่อผู้ใช้</th>
            <th scope="col">รหัสผ่าน</th>            
            <th scope="col">เพศ</th>            
            <th scope="col">ที่อยู่</th>
            <th scope="col">อีเมล</th>
            <th scope="col">เบอร์โทรศัพท์</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
        </tr>
        <tbody class="table-group-divider">
    </thead>
<?php
    while ($row = $stmt->fetch() ) {
?>            
            <tr>
                <th scope="row"><?=$row ["Member_ID"]?></th>
                <td><?=$row ["Name"]?></td>
                <td><?=$row ["Username"]?></td>
                <td><?=$row ["Password"]?></td>
                <td><?=$row ["Gender"]?></td>
                <td><?=$row ["Address"]?></td>
                <td><?=$row ["Email"]?></td>
                <td><?=$row ["Phone"]?></td>                
                <td><a href='admin-member-editform.php?Member_ID=<?=$row["Member_ID"]?>' class="btn btn-warning btn-sm" role="button"><i class="fa-solid fa-pen-to-square"></i></a></td>                
                <td><a href='#' onclick='confirmDelete("<?=$row["Member_ID"]?>")' class="btn btn-danger btn-sm" role="button"><i class="fa-solid fa-trash"></i></a></td>                
            </tr>  
<?php 
    } 
?>      </tbody>
    </table>
    <a href="admin-home.php" class="btn btn-outline-danger" role="button" id="back">ย้อนกลับ</a>
    <a href="admin-member-add.php" class="btn btn-outline-primary" role="button" id="add">เพิ่มสมาชิก</a>
</body>
</html>



        