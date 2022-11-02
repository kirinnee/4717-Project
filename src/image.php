<?php
require_once("./db.php");
$conn = conn();
if(!isset($_GET["id"]) || $_GET["id"] == "") {
    echo "Not ID";
    exit;
}

$id = $_GET["id"];
$type = $_GET["type"];

$r = $conn->query("SELECT * FROM Images WHERE id = '$id'");

if ($r) {
    $row = $r->fetch_assoc();
    if(!isset($row[$type])) {
        echo "Not Found";
        exit;
    }
    $img = $row[$type];
    preg_match("/^data:(image\/[a-z]+;)base64,(.*)$/", $img , $match);
    $mime = $match[1];
    $image = $match[2];
    header("Content-Type: $mime");
    echo base64_decode($image);
    $conn->close();
} else {
    echo "Error: $conn->error";
}
