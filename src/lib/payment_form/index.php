<div class="payment-form">
    <?php (require("./lib/input/index.php"))("pay-name","m-s","Name", "required", "name", "text") ?>
    <?php (require("./lib/input/index.php"))("pay-email","m-s","Email", "required", "email", "text") ?>
    <?php (require("./lib/input/index.php"))("pay-cc","m-s","Card Number", "required placeholder='XXXX-XXXX-XXXX-XXXX'", "card-number", "text") ?>
    <?php (require("./lib/input/index.php"))("pay-date","m-s","Card Number Expiry", "required placeholder='MM/YY'", "card-exp", "text") ?>
    <?php (require("./lib/input/index.php"))("pay-cvv","m-s","CVV", "required  placeholder='XXX'", "card-cvv", "password") ?>
    <?php (require("./lib/button/index.php"))("submit","m-l","PAY NOW", "") ?>
</div>
