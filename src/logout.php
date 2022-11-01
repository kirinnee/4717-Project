<?php
require_once("./classlib/auth.php");

unset($_SESSION['user_id']);

$success = array();
$success[] = "Successfully logged out!";
$_SESSION['success'] = $success;
header("Location: login.php");
exit();
