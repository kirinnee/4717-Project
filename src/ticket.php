<?php require_once("./classlib/auth.php") ?>
<?php privatePage("login.php") ?>
<?php
require_once("./classlib/booking.php");
require_once("./db.php");
$c = function () {
    return conn();
};
$bRepo = new BookingRepo($c);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="ticket.css">
    <?php (require("./lib/head.php"))(
        "Projectionist - My Bookings", [
        "footer",
        "nav_bar",
        "nav_ele",
        "etix",
    ], [
    ], [
    ]);
    ?>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("book") ?>
<div class="full-size f-center">
    <?php
    if (isset($_GET['id'])) {
        $tix = $bRepo->get($_GET['id']);
        if ($tix == null) {
            echo "<div class='not-found'>No Ticket Found</div>";
        } else if ($tix->userId != getUserId()) {
            echo "<div class='not-found'>No Ticket Found</div>";
        } else {
            (require("./lib/etix/index.php"))($tix);

        }
    } else {
        echo "<div class='not-found'>No Ticket Found</div>";
    }
    ?>
</div>

<?php require("./lib/footer/index.php") ?>
</body>
</html>
