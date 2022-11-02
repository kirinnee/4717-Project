<div class="login">
    <div class="form-card">
        <h2>Login</h2>
        <form class="form" onsubmit='return regValid()' method='POST' action='./log.php'>
            <?php (require("./lib/input/index.php"))("login-email","m-s","Email", "required", "email", "email") ?>
            <?php (require("./lib/input/index.php"))("login-password","m-s","Password", "required", "password", "password") ?>
            <div class="label">
                <?php (require("./lib/button/index.php"))("submit","m-l","LOGIN", "") ?>
            </div>
        </form>
        <div class="prompt">
            Not a member? <a href="./register.php">Create an account</a>
        </div>
    </div>

</div>
