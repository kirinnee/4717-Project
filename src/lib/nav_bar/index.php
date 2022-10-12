
<?php

return function($page) {
    $navEle = require("./lib/nav_ele/index.php");
    echo <<<HEREDOCS
    <div class="nav-bar-container">
    HEREDOCS;

    $navEle("Home", "index.php", $page == "home" ? "selected" : "");
    $navEle("Shows", "shows.php", $page == "shows" ? "selected" : "");
    $navEle("Contact", "contact.php", $page == "contact" ? "selected" : "");

    echo <<<HEREDOCS
    </div>
    HEREDOCS;
}
?>

    <?php


    ?>
</div>
