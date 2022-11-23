<?php
    session_start();
    if (empty($_SESSION["userlevel"])){
        header("location: ../home.php");
    }
?>