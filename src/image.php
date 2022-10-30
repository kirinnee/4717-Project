<?php

require_once("./db.php");

$conn = conn();

$id = $_GET["id"];
if($id == null) {
    echo "Not ID";
    exit;
}

$r = $conn->query("SELECT image FROM Movies WHERE id = '$id'");

if ($r) {
    $row = $r->fetch_assoc();
    $img = $row["image"];
    preg_match("/^data:(image\/[a-z]+;)base64,(.*)$/", $img , $match);
    $mime = $match[1];
    $image = $match[2];
    header("Content-Type: $mime");
    echo base64_decode($image);
    $conn->close();
} else {
    echo "Error: $conn->error";
}
