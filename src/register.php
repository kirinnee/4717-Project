<?php require_once("./classlib/auth.php") ?>
<?php publicPage("index.php") ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("./db.php") ?>
<head>
    <?php (require("./lib/head.php"))(
        "Projectionist - Auth", [
        "nav_bar", "nav_ele",
        "login",
        "register",
        "button",
        "input",
        "success_panel",
        "error_panel",
    ], [
    ], [
        "input",
        "register",
    ]);
    ?>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("register") ?>
<?php require("./lib/session_message/index.php") ?>
<?php require_once("./lib/register/index.php") ?>
</body>
</html>
