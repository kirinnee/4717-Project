<?php
return function () {
    $uid = getUserId();
    echo <<<EOL
    <table>
    <tr>
        <th>Ticket</th>
        <th></th>
        <th></th>
        <th></th>

    </tr>
EOL;


    echo <<<EOL
</table>

EOL;
}
?>
