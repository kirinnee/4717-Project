
<?php

return function($page) {
    $navEle = require("./lib/nav_ele/index.php");
    echo <<<HEREDOCS
    <div class="nav-bar-container">
    HEREDOCS;

    $navEle("Home", "index.php", $page == "home" ? "selected" : "");
    $navEle("Shows", "shows.php", $page == "shows" ? "selected" : "");
    $navEle("Contact", "contact.php", $page == "contact" ? "selected" : "");

    if(isset($_SESSION["user_id"])) {
        $navEle("History", "bookings.php", $page == "book" ? "selected" : "");
        $navEle("Logout", "logout.php", $page == "logout" ? "selected" : "");
    } else {
        $navEle("Sign Up", "register.php", $page == "register" ? "selected" : "");
        $navEle("Login", "login.php", $page == "login" ? "selected" : "");

    }

    echo <<<HEREDOCS
    </div>
    HEREDOCS;
}
?>

    <?php


    ?>
</div>
