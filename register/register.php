<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<script>

    function showpassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function showre_password() {
        var x1 = document.getElementById("re_password");
        if (x1.type === "re_password") {
            x1.type = "text";
        } else {
            x1.type = "re_password";
        }
    }

</script> 

<body>

    <fieldset class="border p-4">

        <form action="check-register.php" method="post">

            <fieldset class="border p-4">
                <legend class="float-none w-auto p-2">ลงทะเบียน</legend>

                <!-- Username ต้องมีอักขระ 5 ตัวขึ้นไป -->
                <div>
                    <label class="form-label">Username: </label>
                    <input type="text" name="username" class="form-control" pattern=".{5,}" placeholder = "Username ประกอบด้วยอักขระอะไรก็ได้ 5 ตัวขึ้นไป" required>
                </div><br>
                
                <!-- Password ต้องมีอักขระ 8 ตัวขึ้นไปที่มีตัวเลขอย่างน้อยหนึ่งตัว และตัวพิมพ์ใหญ่และตัวพิมพ์เล็กหนึ่งตัว -->
                <div>
                    <label class="form-label">Password: </label> <input type="checkbox" onclick = "showpassword()"><br>
                    <input type="password" name = "password" id = "password" class="form-control" pattern = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder = "Password ต้องมีอักขระ 8 ตัวขึ้นไปที่มีตัวเลขอย่างน้อยหนึ่งตัว และตัวพิมพ์ใหญ่และตัวพิมพ์เล็กหนึ่งตัว" required><br>            
                    <label class="form-label">Confirm Password: </label> <input type="checkbox" onclick = "showre_password()"><br>
                    <input type="password" name = "re_password" id = "re_password" class="form-control" pattern = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder = "Password ต้องมีอักขระ 8 ตัวขึ้นไปที่มีตัวเลขอย่างน้อยหนึ่งตัว และตัวพิมพ์ใหญ่และตัวพิมพ์เล็กหนึ่งตัว" required>
                </div><br>

                <div>
                    <label class="form-label">Name-Surname: </label>
                    <input type="text" name="name" class="form-control" required>
                </div><br>

                <div>
                    <label class="form-label">Gender: </label><br>
                    <input type="radio" name="gender" value="ชาย" required> Male </input> &nbsp;
                    <input type="radio" name="gender" value="หญิง"> Female </input>                    
                </div><br>

                <div>
                    <label class="form-label">Address: </label><br>
                    <textarea name="address" class="form-control" required></textarea>
                </div><br>

                <div>
                    <label class="form-label">Email: </label>
                    <input type="email" name="email" class="form-control" required>
                </div><br>

                <div>
                    <label class="form-label">Phone: </label>
                    <input type="number" name="phone" class="form-control" required>
                </div><br>

                <input type="submit" name = "register" class="btn btn-primary" value="Register">
                &nbsp;
                <input type="reset" name = "reset" class="btn btn-primary" value="Reset"><br><br>
                <div style="float: right;"><a href="../home.php" class="btn btn-danger" role="button">ย้อนกลับ</a></div>
                <div>
                    <p>เป็นสมาชิกอยู่แล้ว? <a href="../login/login.php">เข้าสู่ระบบ</a></p>
                </div>

            </fieldset>

        </form>

    </fieldset>
    

</body>

</html>