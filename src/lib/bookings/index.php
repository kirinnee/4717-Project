<?php
return function ($bookings) {
    if(count($bookings) > 0 ) {
        echo <<<EOL
    <table class="history">
    <tr>
        <th class="mh">Serial</th>
        <th class="mh">Ticket Type</th>
        <th>Seat Number</th>
        <th class="mh">Bought</th>
        <th>Movie</th>
        <th>Date</th>
        <th>Time</th>
        <th class="mh">Location</th>
        <th>More Info</th>
    </tr>
EOL;
        foreach ($bookings as $b) {
            date_default_timezone_set('Europe/London');

            $bought = new DateTime($b->timeStamp);
            $show = new DateTime($b->showTime);
            $sgTime = new DateTimeZone('Asia/Singapore');

            $bought->setTimezone($sgTime);

            $bo = $bought->format("d M Y, H:i A");
            $stD = $show->format("d M Y");
            $stT = $show->format("H:i A");

            echo <<<EOL
        <tr>
        <td class="mh">$b->uuid</td>
        <td class="mh">$b->ticketTypeName</td>
        <td>$b->seatNo</td>
        <td class="mh">$bo</td>
        <td><a href="shows.php?id=$b->movieId">$b->movieName</a></td>
        <td>$stD</td>
        <td>$stT</td>
        <td class="mh">$b->theatreName</td>
        <td><a href="ticket.php?id=$b->id">View e-Ticket</a></td>
</tr>
EOL;
        }

        echo <<<EOL
</table>
EOL;
    } else {
        echo "<div class='no-booking'> No booking found! </div>";
    }

}
?>
