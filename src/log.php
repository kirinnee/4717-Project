<?php
require_once("./db.php");
require_once("./classlib/auth.php");

$error = array();

$e = $_POST["email"];
$pw = $_POST["password"];
if(!isset($e)) $error[] = "Email not set";
if(!isset($pw)) $error[] = "Password not set";

if(count($error) > 0) {
    $_SESSION['errors'] = $error;
    header("Location: login.php");
    exit();
}

$conn = conn();
$hpw = md5($pw);
try {
    $r = $conn->query("SELECT * FROM Users WHERE email = '$e' AND password = '$hpw'");
    if($r) {
        $success = array();
        $row = $r->fetch_assoc();
        if (isset($row["id"])) {
            $success[] = "Successfully Logged In!";
            $_SESSION['success'] = $success;
            $_SESSION['user_id'] = $row["id"];
            header("Location: index.php");
            exit();
        }
    }
    $error[] = "Incorrect username or password";
    $_SESSION['errors'] = $error;

}catch (\mysqli_sql_exception $e) {
    $error[] = $e->getMessage();
    $_SESSION['errors'] = $error;
}

header("Location: login.php");
exit();
