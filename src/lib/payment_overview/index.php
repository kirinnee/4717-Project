<?php
return function ($post, $tt, $seats) {

    $s = join(" , ", array_map(function ($u) { return $u->no; }, $seats));
    $sJSON = json_encode(array_map(function ($u) { return $u->id; }, $seats));
    echo <<<EOL
<table class="payment-overview">
    <tr>
        <th>Type</th>
        <th>Quantity</th>
        <th>Cost</th>
        <th>Total</th>
    </tr>
EOL;

    $fullTotal = 0;
    foreach ($tt as $t) {

        if(isset($_POST["ticket-count-$t->id"])) {
            $q = $_POST["ticket-count-$t->id"];
            if ($q > 0) {
                $total = $q * $t->cost;
                $fullTotal += $total;
                echo <<<EOL
        <tr>
            <td class="first">$t->name Tickets</td>
            <td>$q</td>
            <td>$ $t->cost</td>
            <td>$ $total <input style="display: none" name="ticket-count-$t->id" value="$q"></td>
        </tr>
EOL;
            }


        }
    }


    echo <<<EOL
<tr>
 <td colspan="3">Total</td>
 <td>$ $fullTotal</td>
</tr>
<tr>
<td>Seats</td>
<td colspan="3">$s <input name="seats" style="display:none" value="$sJSON"></td>
</tr>
</table>
EOL;


}
?>
