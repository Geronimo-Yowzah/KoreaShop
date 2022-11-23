<?php 
    session_start();
    include "connect-register.php"; 
    
    $errors = array();

    if (isset($_POST["register"])) {
        $member = "";
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $re_password = mysqli_real_escape_string($conn, $_POST["re_password"]);
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $role = "customer";

        //กันเผื่อไว้ {

        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION["error"] = "Username is required";
            echo "<script>
            alert('Username is required');
            window.location.href = 'register.php';
            </script>";
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
            $_SESSION["error"] = "Email is required";
            echo "<script>
            alert('Email is required');
            window.location.href = 'register.php';
            </script>";
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
            $_SESSION["error"] = "Password is required";
            echo "<script>
            alert('Password is required');
            window.location.href = 'register.php';
            </script>";
        }

        // }

        if ($password != $re_password) {
            array_push($errors, "The confirm passwords do not match");
            $_SESSION["error"] = "The confirm passwords do not match";
            echo "<script>
            alert('The confirm passwords do not match');
            window.location.href = 'register.php';
            </script>";
        }

        $user_check_query = "SELECT * FROM member WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result["Username"] === $username) {
                array_push($errors, "Username already exists");
                $_SESSION["error"] = "Username already exists";
                echo "<script>
                alert('Username already exists');
                window.location.href = 'register.php';
                </script>";
            }
            if ($result["Email"] === $email) {
                array_push($errors, "Email already exists");
                $_SESSION["error"] = "Email already exists";
                echo "<script>
                alert('Email already exists');
                window.location.href = 'register.php';
                </script>";
            }
        }

        if (count($errors) == 0) {
            // $password = md5($password);

            $sql = "INSERT INTO member (Member_ID, Username, Password, Name, Gender, Address, Email, Phone, Role) VALUES ('$member', '$username', '$password', '$name', '$gender', '$address', '$email', '$phone', '$role')";
            mysqli_query($conn, $sql);

            $_SESSION["username"] = $username;
            $_SESSION["success"] = "You are now logged in";
            header("location: ../login/login.php");
        } else {
            echo "<script>
                alert('ERRORS');
                window.location.href = 'register.php';
                </script>";
        }
    }
?>