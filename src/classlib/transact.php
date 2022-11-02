<?php
require_once("./db.php");
require_once("./classlib/auth.php");
require_once("./classlib/tickets.php");
require_once("./classlib/validator.php");

$error = array();
if (!isLoggedIn()) {
    $error[] = "Please login to perform this action";
    $_SESSION['errors'] = $error;
    header("Location: login.php");
    exit();
}

// Validate post functions
$n = $_POST["name"];
$e = $_POST["email"];
$c = $_POST["card-number"];
$cexp = $_POST["card-exp"];
$cvv = $_POST["card-cvv"];
$seats = $_POST["seats"];
if (!isset($n)) $error[] = "Name is required";
if (!isset($e)) $error[] = "Email is required";
if (!isset($c)) $error[] = "Card Number is required";
if (!isset($cexp)) $error[] = "Card Expiry required";
if (!isset($cvv)) $error[] = "Card CVV is required";
if (!isset($seats)) $error[] = "No seats selected";
if (validName($n) !== "") $error[] = validName($n);
if (validEmail($e) !== "") $error[] = validEmail($e);
if (validCC($c) !== "") $error[] = validCC($c);
if (validExpiry($cexp) !== "") $error[] = validExpiry($cexp);
if (validCVV($cvv) !== "") $error[] = validCVV($cvv);

if (count($error) > 0) {
    $_SESSION['errors'] = $error;
    header("Location: login.php");
    exit();
}

$seatArr = json_decode($seats);

$c = function () {
    return conn();
};

function book($userId, $seatId, $tCost, $ticketId, $e, $n)
{
    $conn = conn();
    $uuid = uniqid('', true);
    $r = $conn->query("INSERT INTO Booking (user_id, uuid, seat_id, timestamp, cost, ticket_type) VALUES ('$userId', '$uuid', '$seatId', UTC_TIMESTAMP(), '$tCost' , '$ticketId' )");
    if (!$r) {
        $conn->close();
        return [$conn->error, ""];
    }

    $r1 = $conn->query("SELECT id FROM Booking WHERE uuid ='$uuid'");
    if($r1) {
        $row = $r1->fetch_assoc();
        $id =$row['id'];
        $message = <<<EOL
    <div style="background: black;">
        <h1 style="color: white">Projectionist Tickets</h1>
        <div>Hello $n!</div>
        <div style="color: white">Thank you for choosing projectionist!</div>
        <div style="color: white">You can view your tickets <a href="http://ernest.devbox.tr8.io:3000/ticket.php?id=$id">here</a></div>
</div>
EOL;

        $headers = 'From: projectionist@localhost' . "\r\n" .
            'Reply-To: projectionist@localhost' . "\r\n" .
            'X-Mailer: PHP/' .phpversion();
        mail($e, "Projectionist Ticket", "", $headers, '-projectionist@localhost');
    }


    return ["", $uuid];
}

$ttRepo = new TicketTypeRepo($c);
$tt = $ttRepo->getAll();

$count = 0;
$uid = getUserId();
foreach ($tt as $t) {
    if (isset($_POST["ticket-count-$t->id"])) {
        $q = $_POST["ticket-count-$t->id"];
        if ($q > 0) {
            $count++;
            while ($q > 0) {
                $seat = array_shift($seatArr);
                $r = book($uid, $seat, $t->cost, $t->id, $e, $n);
                if ($r[0] != "") {
                    $error[] = $r[0];
                    $_SESSION['errors'] = $error;
                    header("Location: login.php");
                    exit();
                }
                $q--;
            }
        }
    }
}
if ($count == 0) {
    $error[] = "No tickets booked because no tickets selected";
    $_SESSION['errors'] = $error;
    header("Location: login.php");
    exit();
}
