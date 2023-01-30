<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Registration</title>
</head>
<body>
    <?php
        include 'includes/header.inc.php';
    ?>
    <div class="login register">
        <h1>Registration</h1>
        <?php
            if (isset($_GET["error"])){
                switch($_GET["error"]){
                    case "emptyinputs":
                        echo "<font color=red><b>You didn't fill all fields!</b></font>";
                        break;
                    case "passwordmismatch":
                        echo "<font color=red><b>Passwords mismatch!</b></font>";
                        break;
                    case "usernametaken":
                        echo "<font color=red><b>Username already exists!</b></font>";
                        break;
                    case "emailtaken":
                        echo "<font color=red><b>Email already taken!</b></font>";
                        break;
                }
            }
        ?>
        <form method="POST" action="includes/register.inc.php">
            <input name="username" placeholder="Enter username"><br><br>
            <input name="password" placeholder="Enter password" type="password"><br><br>
            <input name="repeat_password" placeholder="Confirm your password" type="password"><br><br>
            <input name="email" placeholder="Enter email" type="email"><br><br>
            <button name="submit">Register</button>
        </form>
    </div>
</body>
</html>