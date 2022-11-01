<?php require_once("./classlib/auth.php") ?>
<?php
// redirect if not logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
require_once("./classlib/movie.php");
require_once("./classlib/tickets.php");
require_once("./db.php");
$c = function () {
    return conn();
};
$movieRepo = new MovieRepo($c);
$movie = $movieRepo->get($_GET["id"]);

$ttRepo = new TicketTypeRepo($c);
$tt = $ttRepo->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php (require("./lib/head.php"))(
        "Projectionist", [
        "footer",
        "nav_bar",
        "nav_ele",
        "title",
            "payment_overview",
        "payment_form",
            "input",
            "button",
    ], [
    ], [
            "input",
            "payment_form",
    ]);
    ?>
    <script>
        function getShows() {
            return <?php echo json_encode($movie); ?>;
        }

        function getTix() {
            return <?php echo json_encode($tt); ?>;
        }
    </script>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("home") ?>
<?php (require("./lib/title/index.php"))($movie, false) ?>
<?php (require("./lib/payment_overview/index.php"))($_POST,$tt) ?>
<?php require("./lib/payment_form/index.php") ?>

<?php require("./lib/footer/index.php") ?>
</body>
</html>
