<html>
    <head>
    <?php (require("./lib/head.php"))(
        "Projectionist", [
            "carousel",
            "date_picker",
            "footer",
            "nav_bar",
            "nav_ele" ,
            "show",
            "shows"
        ], [
            "date_picker",
            "carousel",
            "show",
        ]);
    ?>
    </head>
<body>
    <?php (require("./lib/nav_bar/index.php"))("home") ?>
    <?php (require("./lib/carousel/index.php"))() ?>
    <?php (require("./lib/date_picker/index.php"))() ?>
    <?php require("./lib/shows/index.php") ?>

    <?php require("./lib/footer/index.php") ?>

</body>
</html>
