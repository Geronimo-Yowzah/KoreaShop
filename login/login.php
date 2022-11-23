<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Login</title> 
    <style>
        i {
            font-size: 80%;
        }
        body > div {
            width: 500;
            height: 500;
        }
    </style>
    
    <script>
        function show() {
            var x = document.getElementById("myPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }   
    </script> 
</head>
<body> 
    <div>
    <fieldset class="border p-4">        
    <form action="check-login.php" method="POST">
        <fieldset class="border p-4">  
            <legend  class="float-none w-auto p-2">เข้าสู่ระบบ</legend>          
            <div>
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name = "username" value = "<?php if(isset($_COOKIE['userlogin'])){ 
                                                                                                        echo $_COOKIE['userlogin'];} ?>" required>
                <!-- <i>ประกอบด้วยตัวเลข ตัวอักษร หรือ _ ตั้งแต่ 8 ตัวขึ้นไป</i> -->
            </div><br>
            <div>
                <label for="myPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="myPassword" name = "password" value = "<?php if(isset($_COOKIE['userpassword'])){ 
                                                                                                        echo $_COOKIE['userpassword'];} ?>" required>
                <!-- <i>ประกอบด้วยอักขระอะไรก็ได้ 8 ตัวขึ้นไป</i> -->
                <input type="checkbox" onclick="show()"> แสดงรหัสผ่าน <br><br>
            </div><br>
            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
        </fieldset><br>
    </form>
    <p>เพิ่งเคยเข้ามาครั้งแรก? <a href="../register/register.php">ลงทะเบียน</a></p>
    <div style="float: right;"><a href="../home.php" class="btn btn-danger" role="button">ย้อนกลับ</a></div>
    </fieldset><br>   
    
    </div>
</body>
</html>



