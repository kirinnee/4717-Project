<?php
return function ($movie) {
    echo <<<EOL
    <div class="description">
        <div class="duration">Duration: $movie->duration minutes </div>
        <div>
            $movie->desc
        </div>
        
    </div>
EOL;
}
?>
