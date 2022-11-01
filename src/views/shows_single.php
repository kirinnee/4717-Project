<html lang="en">
<?php
require_once("./classlib/movie.php");
require_once("./classlib/tickets.php");
require_once("./db.php");
$c = function () {
    return conn();
};
$movieId = $_GET["id"];
$movieRepo = new MovieRepo($c);
$movie = $movieRepo->get($_GET["id"]);

$ttRepo = new TicketTypeRepo($c);
$tt = $ttRepo->getAll();
?>
<head>
    <link rel="stylesheet" href="single.css"/>
    <?php
    $title = $movie == null ? "Not Found" : $movie->name;
    (require("./lib/head.php"))(
        "Projectionist - $title",
        [
            "footer",
            "nav_bar",
            "nav_ele",
            "trailer",
            "title",
            "description",
            "showtime",
            "seating",
            "ticket_selector",
        ], [
    ], [
            "showtime",
            "ticket_selector",
            "seating",
        ]
    );
    ?>

    <script>
        function getShows() {
            return <?php echo json_encode($movie); ?>;
        }
    </script>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("shows") ?>
<?php
if ($movie == null) {
    echo <<<EOL
<div class='not-found'>
    <div>
        Not Found
    </div>
</div>"
EOL;
} else {
    (require("./lib/trailer/index.php"))($movie);
    (require("./lib/title/index.php"))($movie);

    $movieId = $_GET["id"];
    echo "<form action='./payment.php?id=$movieId' method='POST'><div class='part-way'>";
    (require("./lib/description/index.php"))($movie);
    (require("./lib/showtime/index.php"))($movie);
    echo "</div>";
    (require("./lib/seating/index.php"))($movie, $tt);
    echo "</form>";
}
?>
<?php require("./lib/footer/index.php") ?>
</body>
</html>
