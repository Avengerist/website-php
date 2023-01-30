<?php
session_start();
echo '<script language=javascript>
function submitPostLink()
{
document.postlink.submit();
}
</script>';
    echo '<div id="header">
        <div id="header-image"></div>
        <div id="menu">
            <a href="index.php">
                <div class="menu-item">Main Page</div>
            </a>
            <a href="profile.php">
                <div class="menu-item">Profile</div>
            </a>
            <a href="books.php">
                <div class="menu-item">Books</div>
            </a>
            <a href="events.php">
                <div class="menu-item">Events</div>
            </a>
            <a href="faq.php">
                <div class="menu-item">FAQ</div>
            </a>';
            if (isset($_SESSION["username"])){
                echo    '<form id="form-logout" action="includes/logout.inc.php" name=postlink method="post">
                            <input type="hidden" name="logout" value="">
                        </form>
                        <a href="#" onclick="submitPostLink()">
                            <div class="menu-item">Logout</div>
                        </a>';
            }
            else{
                echo '<a href="login.php">
                        <div class="menu-item">Login</div>
                      </a>';
            }
        echo '</div>
    </div>';
?>