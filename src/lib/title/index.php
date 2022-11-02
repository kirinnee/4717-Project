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
        <a class="genre" href="shows.php?genre=$v->name">
            $upper
        </a>
EOL;

        }

    }
    echo <<<EOL
    </div>
EOL;
}
?>
