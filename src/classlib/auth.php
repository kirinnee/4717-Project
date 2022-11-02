<?php

session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserId() {
    return $_SESSION['user_id'];
}

function privatePage($redirect) {
    if(!isLoggedIn()) {
        header("Location: $redirect");
        exit();
    }
}

function publicPage($redirect) {
    if(isLoggedIn()) {

        header("Location: $redirect");
        exit();
    }

}

?>
