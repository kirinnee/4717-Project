<?php
return function ($tt) {
    echo <<<EOL
    <div class="ticket-input">
        <div class="label">$tt->name</div>
        <div class="numeric">
            <div class="minus">-</div>
            <input name="ticket-count-$tt->id" value="0" prev="0" cost="$tt->cost"/>
            <div class="plus">+</div>
        </div>
        <div class="label"> $ $tt->cost / Ticket </div>
    </div>

EOL;
}
?>
