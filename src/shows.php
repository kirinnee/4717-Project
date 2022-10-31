<?php
$id = $_GET["id"];
if ($id == "") {
    require_once("./views/shows_all.php");
} else {
    require_once("./views/shows_single.php");
}
