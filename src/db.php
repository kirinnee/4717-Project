<?php
function conn() {
    $db = new mysqli('localhost', 'root', '','ie4717-final-howard-ernest');
    if(mysqli_connect_errno()) {
        echo 'Error: Could not connect to database!';
        exit;
    }
    return $db;
}
?>
