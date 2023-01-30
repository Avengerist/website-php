<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Login</title>
</head>
<body>
    <?php 
        include 'includes/header.inc.php';
    ?>
    <div class="login"> 
        <h1>Login</h1>
        <?php
           if (isset($_GET["error"])){
                if ($_GET["error"] == "incorrect"){
                    echo "<font color=red><b>Username or password is incorrect!</b></font>";
                }
           } 
        ?>
        <form method="POST" action="includes/login.inc.php">
            <input name="username" placeholder="Enter username"><br><br>
            <input name="password" placeholder="Enter password" type="password"><br><br>
            <button name="submit">Login</button>
        </form>
        <div id="registerlink">
            <a href="register.php">Registartion is here!</a>
        </div>
    </div>
</body>
</html>