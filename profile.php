
    <head>
        <link rel="stylesheet" href="css/styles.css">

</head>
    <body>
<?php
    include 'includes/header.inc.php';

    
    if (isset($_SESSION["username"])){
        include 'includes/db.inc.php';
        include 'includes/functions.php';
        
        GetPersonalData($connection,$_SESSION["account_id"]);

        echo "Welcome, " . $_SESSION["username"];
        if ((!isset($_SESSION["firstname"])) && (!isset($_SESSION["lastname"]))){
            echo "<h1>" . $_SESSION["username"] . "</h1>";
        }
        else {
            echo "<h1>" . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "</h1>";
        }
        echo "<img height=200 width=280 src=". $_SESSION["avatar"] . " alt=" . ">";
        echo '<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
          <input type="file" name="imageToUpload"><br><br>
          <input type="submit" value="Upload Image" name="upload">
        </form>';

        echo '<h2>Change Personal Data</h2>
        <form method="POST" action="includes/profile.inc.php">
            <input placeholder="Enter Firstname" name="firstname"><br><br>
            <input placeholder="Enter Lastname" name="lastname"><br><br>
            <button name="submit">Change</button>        
        </form>';

    }
    else {
        echo "You are not authorized!";
    }
?>
</body>
