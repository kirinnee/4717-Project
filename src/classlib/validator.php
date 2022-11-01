<?php
function validName($name)
{
    if (strlen($name) < 2) {
        return "Name needs to be more than 1 character";
    }
    if (strlen($name) > 64) {
        return "Name cannot be more that 64 character";
    }
    if (preg_match("/^.*\s+$/", $name)) {
        return "Name cannot end with spaces";
    }
    if (preg_match("/^.*-+$/", $name)) {
        return "Name cannot end with -";
    }
    if (preg_match("/^.*_+$/", $name)) {
        return "Name cannot end with _";
    }
    if (preg_match("/^[a-zA-Z0-9-_\s]+$/", $name)) {
        return "";
    }
    return "Name needs to be alphanumeric, _ or -";
}

function validEmail($email)
{
    if (strlen($email) < 2) {
        return "Email needs to be more than 1 character";
    }
    if (strlen($email) > 64) {
        return "Email cannot be more that 64 character";
    }
    if (count(explode("@", $email)) !== 2) {
        return "Email must have 1 @ sign, only";
    }
    if (!preg_match("/^[a-zA-Z].*$/", $email)) {
        return "Email must start with alphabet";
    }
    if (!preg_match("/^.*@([a-z][a-z\-0-9]*\.)+([a-z]{2,})$/", $email)) {
        return "Email must conform to DNS specification, and cannot be TLD";
    }
    return "";

}

function validPassword($password)
{
    if (strlen($password) < 8) {
        return "Password needs to be at least 8 characters";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Password must have a lower-case character";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Password must have a upper-case character";
    }
    if (!preg_match("/[0-9]/", $password)) {
        return "Password must have a number";
    }
    if (!preg_match("/[^a-zA-Z0-9]/", $password)) {
        return "Password must have a special character";
    }
    return "";
}


?>
