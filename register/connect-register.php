<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "koreashop";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $pdo = new PDO("mysql:host=localhost; dbname=koreashop;charset=utf8","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    } 

?>