<?php
    if (isset($_POST["submit"])){
        include 'db.inc.php';
        include 'functions.php';
        $username=$_POST["username"];
        $password=$_POST["password"];
        if (isAuthorized($connection,$username,$password) == true){
            header("Location: ../profile.php");
        } else {
            header("Location: ../login.php?error=incorrect");
        }
    } else{
        header("Location: ../login.php");
    }
?>