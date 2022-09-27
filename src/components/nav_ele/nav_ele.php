<?php
return function($name, $link) {
    echo <<<EOL
<div class="nav-ele-header">
    <a class="nav-ele-link" href="$link">$name</a>
</div>
EOL;
}

?>