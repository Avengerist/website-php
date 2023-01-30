<?php
session_start();
    if (isset($_POST["upload"])){
        include 'db.inc.php';
        include 'functions.php';
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
        if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
            if (UploadImage($connection,$_SESSION["account_id"],$target_file)){
                header("Location: ../profile.php?upload=success");
                exit();
            } else {
                header("Location: ../profile.php?upload=fail");
                exit();
            }
        } else {
            header("Location: ../profile.php?upload=fail");
            exit();
        }

    } else {
        header("Location: ../profile.php");        
    }
?>