<!DOCTYPE html>
<html lang="en">
<?php
require_once("./classlib/movie.php");
require_once("./db.php");
$c = function () {
    return conn();
};
$movieRepo = new MovieRepo($c);
$movies = $movieRepo->getAll();
?>
<head>
    <script defer>
        const getMovies = () => {
            return <?php echo json_encode($movies)?>;
        };
    </script>
    <?php (require("./lib/head.php"))(
        "Projectionist", [
        "carousel",
        "date_picker",
        "footer",
        "nav_bar",
        "nav_ele",
        "shows"
    ], [
        "date_picker",
        "carousel",
        "shows",
    ], []);
    ?>

</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("home") ?>
<?php
(require("./lib/carousel/index.php"))([
    $movies['1'],
    $movies['2'],
    $movies['3'],
    $movies['4'],
], "real1");
?>
<?php (require("./lib/date_picker/index.php"))() ?>
<?php require("./lib/shows/index.php") ?>
<?php require("./lib/footer/index.php") ?>
<script>
    chooseDate(1);
</script>
</body>
</html>
