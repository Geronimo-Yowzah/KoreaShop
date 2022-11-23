<?php 
    include "connect.php";
    include "hack.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Admin HOME</title>
    <style>        
        h1 {
            margin-top: 2%;
            margin-left: 2%;
        }        
        nav {
            height: 10em;
            
        }
        section {
            width: 900px;
        }
        #result, #result2, #result3 {
            display: inline-block;            
            border-color: black;
            border-radius: 3px;  
            box-shadow: 0px 0 2px 0 rgba(0,0,0,0.40);
            padding: 5px;
            margin: 2%;            
        }        
    </style>
    <script>
        fetch('./sales.json')
            .then(function (response) {
                return response.json()
            })
            .then(function (jsonData) {
                getData(jsonData)
            });

        
        function getData(jsonData){            
            let result = document.getElementById('result')
            let result2 = document.getElementById('result2')
            let result3 = document.getElementById('result3')

            for (let i=0; i<jsonData.data.length; i++) {
                if (jsonData.data[i].year == "2563"){
                    let content = jsonData.data[i].month + ': ' +
                    jsonData.data[i].monthly_sales + ' บาท'

                    let div = document.createElement('div')
                    div.innerHTML = content
                    result.appendChild(div)
                }
            }
            

            for (let i=0; i<jsonData.data.length; i++) {
                if (jsonData.data[i].year == "2564"){
                    let content = jsonData.data[i].month + ': ' +
                    jsonData.data[i].monthly_sales + ' บาท'

                    let div = document.createElement('div')
                    div.innerHTML = content
                    result2.appendChild(div)
                }
            }

            for (let i=0; i<jsonData.data.length; i++) {
                if (jsonData.data[i].year == "2565"){
                    let content = jsonData.data[i].month + ': ' +
                    jsonData.data[i].monthly_sales + ' บาท'

                    let div = document.createElement('div')
                    div.innerHTML = content
                    result3.appendChild(div)
                }
            }
        }
        
    </script>
    <style>
        
    </style>
</head>

<?php
    // $stmt = $pdo->prepare("SELECT * FROM confirm_order JOIN orders ON orders.Order_ID = confirm_order.Order_ID;");
    // $stmt->execute();

    $stmt = $pdo->prepare("SELECT orders.Order_ID, member.Name , orders.Order_Date, orders.Net, SUM(buying.Amount) ,confirm_order.Status FROM buying 
                            JOIN orders ON orders.Order_ID = buying.Order_ID
                            JOIN member ON member.Member_ID = buying.Member_ID
                            JOIN confirm_order ON confirm_order.Order_ID = orders.Order_ID
                            GROUP BY 1;");
    $stmt->execute();
?>

<body>
    <center>
    <nav>
    <h1>Admin tool</h1>
            
        <a href="admin-product-list.php" class="btn btn-outline-primary" role="button">สินค้า</a>
        <a href="admin-member-list.php" class="btn btn-outline-primary" role="button">สมาชิก</a> 
        <a href="../login/logout.php" class="btn btn-outline-danger" role="button">ออกจากระบบ</a>              
    
    </nav>
    
    
    <section>
        <h2>รายการการสั่งซื้อของลูกค้าและการชำระเงิน</h2>
    
        <table class="table">
            <tr>
                <th>ออเดอร์</th>
                <th>วันที่</th>
                <th>ชื่อ</th>
                <th>ยอดรวม</th>
                <th>จำนวนสินค้า</th>
                <th>สลิป</th>
            </tr>
            <tbody class="table-group-divider">
<?php 
        while($row = $stmt->fetch()){
            $imageURL = '../upload-system/'.$row['Status'];
?>
            <tr>
                <td><?=$row["Order_ID"]?></td>
                <td><?=$row["Order_Date"]?></td>
                <td><?=$row["Name"]?></td>
                <td><?=$row["Net"]?></td>
                <td><?=$row["SUM(buying.Amount)"]?></td>
                <td><img src="<?=$imageURL?>" width="250px"></td>
            </tr>
<?php 
        } 
?>
            </tbody>
        </table>
    <br><br><br>
    
    <div id="result">
        <h2>ยอดขายแต่ละเดือน ปี 2563</h2>
    </div>
    
    <div id="result2">
        <h2>ยอดขายแต่ละเดือน ปี 2564</h2>
    </div>     
    <div id="result3">
        <h2>ยอดขายแต่ละเดือน ปี 2565</h2>
    </div>   
    </section>
    </center> 
</body>
</html>