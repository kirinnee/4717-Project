<?php require_once("./classlib/auth.php") ?>
<?php privatePage("login.php") ?>
<?php
require_once("./classlib/booking.php");
require_once("./db.php");
$c = function () {
    return conn();
};
$bRepo = new BookingRepo($c);
$booking = $bRepo->geByUserId(getUserId());
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
    ]);
    ?>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("book") ?>
<div class="page-controller">
    <?php (require("./lib/bookings/index.php"))($booking) ?>

    <?php require("./lib/footer/index.php") ?>
</div>

</body>
</html>
