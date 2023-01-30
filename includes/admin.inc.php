<?php
session_start();
    if (isset($_POST["submitBook"])){
        include 'db.inc.php';
        include 'functions.php';
        $target_dir = "../books/";
        $target_file = $target_dir . basename($_FILES["bookToUpload"]["name"]);
        if (move_uploaded_file($_FILES["bookToUpload"]["tmp_name"], $target_file)) {
            if (UploadBook($connection,$_POST["Author"],$_POST["Title"],$_POST["Publisher"],$target_file)){
                header("Location: ../admin.php?upload=success");
                exit();
            } else {
                header("Location: ../admin.php?upload=fail1");
                
                exit();
            }
        } else {
            header("Location: ../admin.php?upload=fail2");
            exit();
        }

    } else {
        header("Location: ../admin.php");        
    }
?>