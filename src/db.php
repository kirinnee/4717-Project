<?php
function conn() {
    $db = new mysqli('db', 'root', 'password','ie4717');
    if(mysqli_connect_errno()) {
        echo 'Error: Could not connect to database!';
        exit;
    }
    return $db;
}
?>
