<?php
return function($name, $link, $selected) {
    echo <<<EOL
<div class="nav-ele-header $selected">
    <a class="nav-ele-link" href="$link">$name</a>
</div>
EOL;
}
?>
