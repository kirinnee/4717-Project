<?php
return function ($booking) {
    $showTime = (new DateTime($booking->showTime))->format('m D Y, H:i A');
    $tt = strtoupper("$booking->ticketTypeName Ticket");
    echo <<<EOL
    <div class="tix">
        <div class="movie-title">
            $booking->movieName
        </div>
        <div class="type">
            $tt
        </div>
        <div class="serial-number">
            Ticket Number: $booking->uuid
        </div>
        <div class="bar-code">
            $booking->uuid
        </div>
        <div class="logs">
            $showTime @ $booking->theatreName
        </div>
        <div class="address">
            $booking->theatreAdd
        </div>
    </div>

EOL;
}
?>
