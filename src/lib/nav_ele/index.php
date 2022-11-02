<?php
return function($name, $link, $selected) {
    echo <<<EOL
<a class="nav-ele-header $selected"  href="$link">
    <div class="nav-ele-link">$name</div>
</a>
EOL;
}
?>
