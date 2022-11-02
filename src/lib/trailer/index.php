<?php
return function($movie) {
    echo <<<EOL
    <div class="trailer-holder">
        <iframe
        class="iframe"
            src="$movie->trailer"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
EOL;
}
?>
