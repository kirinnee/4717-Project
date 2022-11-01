<form class="payment-form">
    <?php (require("./lib/input/index.php"))("pay-name","m-s","Name", "required", "name", "text") ?>
    <?php (require("./lib/input/index.php"))("pay-email","m-s","Email", "required", "email", "text") ?>
    <?php (require("./lib/input/index.php"))("pay-cc","m-s","Card Number", "required", "card", "text") ?>
    <?php (require("./lib/button/index.php"))("submit","m-l","REGISTER", "") ?>
</form>
