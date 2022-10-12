<html>
    <head>
    <?php (require("./lib/head.php"))(
        "Projectionist - Shows", [
            "footer", "nav_bar", "nav_ele"
        ], []);
    ?>
    </head>
    <body>
    <?php (require("./lib/nav_bar/index.php"))("shows") ?>
        <?php require("./lib/footer/index.php") ?>
    </body>
</html> 
