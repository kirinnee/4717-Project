<?php
return function () {

    $today = date('Y-m-d', strtotime("today"));

    $days = array();
    for ($i = 1; $i < 5; $i++) {
        $days[] = strtotime("+ $i day");
    }

    echo <<<EOL
<div class="date-picker-container">
    <div class="date-picker">
        <div class="date chosen normal"  option="1" date-val="null" onclick="chooseDate(1)">
            <div>ALL WEEK</div>
        </div>
        <div class="date normal" option="2" date-val="$today" onclick="chooseDate(2)">
            <div>TODAY</div>
        </div>
EOL;

    foreach ($days as $key => $day) {
        $option = $key + 3;
        $cDate = date('Y-m-d',$day);
        $dateFormat = date('d M',$day);
        $dayFormat = date('D',$day);
        echo <<<EOL
            <div class="date date-day" option="$option" date-val="$cDate" onclick="chooseDate($option)">
                <div class="actual-date">
                    <div>$dateFormat</div>
                </div>
                <div class="day">
                    <div>$dayFormat</div>
                </div>
            </div>
        EOL;
    }
    echo <<<EOL
    </div>
</div>
EOL;
}
?>
