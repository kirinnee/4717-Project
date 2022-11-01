<?php
return function ($movie, $showGenre = true) {
    echo <<<EOL
    <div class="title">
        $movie->name
    </div>
    <div class="genre-holder">
EOL;
    if ($showGenre) {
        foreach ($movie->genre as $v) {
            $upper = strtoupper($v->name);
            echo <<<EOL
        <div class="genre">
            $upper
        </div>
EOL;

        }

    }
    echo <<<EOL
    </div>
EOL;
}
?>
