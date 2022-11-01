<?php
return function ($movie) {
    echo <<<EOL
    <div class="description">
        $movie->desc
    </div>
EOL;
}
?>
