<?php require_once("./classlib/auth.php") ?>
<?php privatePage("login.php") ?>
<?php require_once("./classlib/transact.php") ?>;
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="payment_success.css">
    <?php (require("./lib/head.php"))(
        "Projectionist", [
        "footer",
        "nav_bar",
        "nav_ele",
        "title",
    ], [
    ], [
    ]);
    ?>
</head>
<body>
<?php (require("./lib/nav_bar/index.php"))("home") ?>
<div class="box">
    <div class="thank-you">
        Thank you for watching with Projectionist!
    </div>
</div>

<?php require("./lib/footer/index.php") ?>
</body>
</html>
