<?php
return function ($post, $tt) {
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
            $total = $q * $t->cost;
            $fullTotal += $total;
            echo <<<EOL
        <tr>
        <td class="first">$t->name Tickets</td>
        <td>$q</td>
        <td>$ $t->cost</td>
        <td>$ $total</td>
</tr>
EOL;

        }
    }


    echo <<<EOL
<tr>
 <td colspan="3">Total</td>
 <td>$ $fullTotal</td>
</tr>
</table>
EOL;


}
?>
