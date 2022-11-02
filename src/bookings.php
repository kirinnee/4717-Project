<?php require_once("./classlib/auth.php") ?>
<?php
privatePage("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="payment_success.css">
    <?php (require("./lib/head.php"))(
        "Projectionist - My Bookings", [
        "footer",
        "nav_bar",
        "nav_ele",
            "bookings",
    ], [
    ], [
            "bookings",
    ]);
    ?>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("book") ?>
<?php (require("./lib/bookings/index.php"))() ?>

<?php require("./lib/footer/index.php") ?>
</body>
</html>
