<?php
return function($id, $class, $value, $attr) {
    echo <<<EOL
    <div class="generic-button-cover $class"  id="$id">
        <input class="generic-button" type="submit" value="$value" $attr>
    </div>
EOL;
}
?>
