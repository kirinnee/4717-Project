<html>
<head>
    <?php (require("./lib/head.php"))(
        "Projectionist - Contact", [
            "footer", "nav_bar", "nav_ele","contact_card"
        ], []);
    ?>
    </head>
    <body>
    <?php (require("./lib/nav_bar/index.php"))("contact") ?>
        <?php require("./lib/contact_card/index.php") ?>

        <?php require("./lib/footer/index.php") ?>
    </body>
</html>
