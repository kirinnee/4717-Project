<?php
return function($title, $img, $description, $date){
    echo <<<EOL
<div class="show">
    <div class="date">
        <div class="actual-date">
        <div>30 SEP</div>

        </div>
        <div class="day">
            <div>FRI</div>
        </div>
    </div>
    <div class="content">
        <div class="image">
            <img src="$img" alt="$title">
        </div>
        <div class="description">
            $description
        </div>
        <a class="action">
            Book Now!
        </a>
    </div>

</div>
EOL;
}
?>
