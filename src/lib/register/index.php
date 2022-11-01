<div class="register">
    <div class="form-card">
        <h2>Register</h2>
        <form class="form" onsubmit='return regValid()' method='POST' action='./reg.php'>
            <?php (require("./lib/input/index.php"))("reg-name","m-s","Name", "required", "name", "text") ?>
            <?php (require("./lib/input/index.php"))("reg-email","m-s","Email", "required", "email", "email") ?>
            <?php (require("./lib/input/index.php"))("reg-pw","m-s","Password", "required", "pw", "password") ?>
            <?php (require("./lib/input/index.php"))("reg-pw-r","m-s","Repeat Password", "required", "pw-r", "password") ?>
            <div class="label">
               <?php (require("./lib/button/index.php"))("submit","m-l","REGISTER", "") ?>
            </div>
        </form>
    </div>

</div>
