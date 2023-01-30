<?php
    if (isset($_POST["submit"])){
    session_start();
       include 'db.inc.php';
       include 'functions.php';
        $firstname=$_POST["firstname"];
        $lastname=$_POST["lastname"];
        SetPersonalData($connection,$firstname,$lastname,$_SESSION["account_id"]);
    header("Location: ../profile.php");
    } else {
        header("Location: ../profile.php");
    }
?>