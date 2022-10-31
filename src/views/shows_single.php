<html lang="en">
<?php
require_once("./classlib/movie.php");
require_once("./db.php");
$c = function () {
    return conn();
};
$movieRepo = new MovieRepo($c);
$movie = $movieRepo->get($_GET["id"]);
?>
<head>

    <link rel="stylesheet" href="shows.css"/>
    <?php (require("./lib/head.php"))(
        "Projectionist - $movie->name",
        [
            "footer",
            "nav_bar",
            "nav_ele",
        ], [
        ], []
    );
    ?>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("shows") ?>
<?php
    if($movie == null) {
        echo "<div style='color:white'>Not Found </div>";
    } else {
        echo <<<EOL
<div style="color:white;">
    <?php echo json_encode($movie); ?>
</div>
EOL;

    }
?>

<?php require("./lib/footer/index.php") ?>
</body>
</html>
