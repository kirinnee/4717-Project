<?php
require_once("./db.php");
require_once("./classlib/auth.php");
require_once("./classlib/validator.php");

$error = array();

$n = $_POST["name"];
$e = $_POST["email"];
$pw = $_POST["pw"];
$pwr = $_POST["pw-r"];
if(!isset($n)) $error[] = "Name not set";
if(!isset($e)) $error[] = "Email not set";
if(!isset($pw)) $error[] = "Password not set";
if(!isset($pwr)) $error[] = "Repeat password not set";
$nValid = validName($n);
if($nValid !== "") $error[] = $nValid;
$eValid = validEmail($e);
if($eValid !== "") $error[] = $eValid;
$pwValid = validPassword($pw);
if($pwValid !== "") $error[] = $pwValid;
if($pw !== $pwr) $error[] = "Passwords do not match";

if(count($error) > 0) {
    $_SESSION['errors'] = $error;
    header("Location: auth.php");
    exit();
}

$conn = conn();
$hpw = md5($pw);
try {
    $r = $conn->query("INSERT INTO Users (name, email, password) VALUES ('$n', '$e', '$hpw')");
    if($r) {
        $success = array();
        $success[] = "Successfully registered user!";
        $_SESSION['success'] = $success;
        header("Location: login.php");
        exit();

    } else {
        $error[] = $conn->error;
        $_SESSION['errors'] = $error;
    }
}catch (\mysqli_sql_exception $e) {
    $error[] = $e->getMessage();
    $_SESSION['errors'] = $error;
}

header("Location: register.php");
exit();
