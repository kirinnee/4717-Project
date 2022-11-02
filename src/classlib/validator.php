<?php
function isint($number)
{
    $number = filter_var($number, FILTER_VALIDATE_INT);
    return ($number !== FALSE);
}

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

function validCC($cc)
{
    if (preg_match("/[^0-9-\s]+/", $cc)) {
        return "Only digits and '-' accepted";
    }

    if (!preg_match("/^\d\d\d\d-\d\d\d\d-\d\d\d\d-\d\d\d\d$/", $cc))
        return "CC needs to be in xxxx-xxxx-xxxx-xxxx format";

    $nCheck = 0;
    $bEven = false;

    while (preg_match('/\D/', $cc)) {
        $cc = preg_replace('/\D/', "", $cc);
    }

    for ($n = strlen($cc) - 1; $n >= 0; $n--) {
        $cDigit = $cc[$n];
        $nDigit = intval($cDigit);

        if ($bEven && ($nDigit *= 2) > 9) $nDigit -= 9;

        $nCheck += $nDigit;
        $bEven = !$bEven;
    }

    return ($nCheck % 10) == 0 ? "" : "Not a valid Credit Card Number";
}

function validExpiry($exp)
{
    if (count(explode("/", $exp)) !== 2) {
        return "Format in MM/YY";
    }
    $temp = explode("/", $exp);
    $a = $temp[0];
    $b = $temp[1];
    if (!isint($a)) return "MM has to be a valid month in digits";
    $m = intval($a);
    if ($m < 1 || $m > 12) return "MM has to be 1 to 12";
    if (!isint($b)) return "YY has to be a valid year in digits";
    $yy = intval($b);
    $cY = intval(date("Y"));
    $cM = intval(date("m"));
    if ($yy + 2000 < $cY) {
        return "The card cannot be expired";
    } else if ($yy + 2000 > $cY) {
        return "";
    } else if ($m < $cM) {
        return "The card cannot be expired";
    } else if ($m === $cM) {
        return "The card expires this month";
    }
    return "";
}

function validCVV($cvv) {
    if(strlen($cvv) !== 3) {
        return "CVV is 3 digits long";
    }
    if(preg_match("/\D/", $cvv)) {
        return "CVV only allow digits";
    }
    return "";
}
?>
