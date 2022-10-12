<?php
return function($title, $img, $description, $date){
    echo <<<EOL
<div class="show">
    <div class="date">
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
