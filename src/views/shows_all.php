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
    <link rel="stylesheet" href="shows.css"/>
    <?php (require("./lib/head.php"))(
        "Projectionist - Shows", [
        "footer",
        "nav_bar",
        "nav_ele",
        "show_card",
        "search",
    ], [
    ], ["show_card", "search"]
    );
    ?>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("shows") ?>

<?php (require("./lib/search/index.php")) ?>
<div class="no-shows-found" id="no-shows-found">No Shows found</div>
<div class="shows" id="shows">

</div>
<?php require("./lib/footer/index.php") ?>
</body>
</html>
