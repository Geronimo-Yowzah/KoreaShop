<?php
    //ติดต่อฐานข้อมูล
    $pdo = new PDO("mysql:host=localhost; dbname=koreashop; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
?>