<?php
$errorPanel = require_once("./lib/error_panel/index.php");
$successPanel = require_once("./lib/success_panel/index.php");
if(isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $v) {
        $errorPanel("", $v, "");
    }
    unset($_SESSION['errors']);
}
if(isset($_SESSION['success'])) {
    foreach ($_SESSION['success'] as $v) {
        $successPanel("", $v, "");
    }
    unset($_SESSION['success']);
}
?>
