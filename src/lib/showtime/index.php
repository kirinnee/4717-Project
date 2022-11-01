<?php
return function ($movie) {

    // format movie

    $shows = array();
    foreach ($movie->shows as $k => $v) {
        if (!isset($shows[$v->date])) {
            $shows[$v->date] = array();
        }
        $shows[$v->date][] = $v;
    }

    ksort($shows);

    $showsJSON = json_encode($shows);

    echo <<<EOL
    <div class="show-time">
        <form method="POST" onsubmit="return (()=>{})()">
            <select class="available-date" name="date">
EOL;
    $flag = false;
    $firstDate = "";
    foreach ($shows as $k => $v) {
        $date = strtotime($k);
        $today = strtotime("today");
        $d = date('M d', $date);
        if ($date == $today) {
            $d = "Today";
        } else if ($date < $today) {
            continue;
        }
        if (!$flag) {
            echo "<option selected value='$k'>$d</option>";
            $flag = true;
            $firstDate = $k;
        } else {
            echo "<option value='$k'>$d</option>";
        }
    }
    echo <<<EOL
        </select>
        <table class="selection">
            <tr>
                <th>Theatre</th>
                <th>Time</th>
                <th>Select</th>
            </tr>
EOL;
    $flag1 = false;
    foreach ($shows[$firstDate] as $v) {
        $time = date('h:i A', strtotime($v->time));
        $loc = $v->theatre->name;
        $selected = "";
        if(!$flag1) {
            $selected = "checked";
            $flag1 = true;
        }
        echo <<<EOL
                <tr>
                    <td>$loc</td>
                    <td>$time</td>
                    <td><input type="radio" $selected name="show" value="$v->id"></td>
                </tr>
        EOL;
    }
    echo <<<EOL
            </table>
        </form>
    </div>
EOL;
}
?>
