<?php
if (isset($_POST["submit"])){
    include 'functions.php';
    include 'db.inc.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];
    $email = $_POST["email"];
    if (emptyInputs($username,$password,$repeat_password,$email) == true)
    {
        header("Location: ../register.php?error=emptyinputs");
        exit();
    }
    if (passwordMismatch($password,$repeat_password)){
        header("Location: ../register.php?error=passwordmismatch");
        exit();
    }
    if (usernameTaken($connection,$username) == true){
        header("Location: ../register.php?error=usernametaken");
        exit();
    }
    if (emailTaken($connection,$email) == true){
        header("Location: ../register.php?error=emailtaken");
        exit();
    }

    createUser($connection,$username,$password,$email);
}
else{
        header("Location: ../register.php");
}
?>

