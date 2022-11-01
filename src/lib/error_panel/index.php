<?php
return function($class, $value, $attr) {
    echo <<<EOL
    <div class="error-panel $class" $attr>
        $value
    </div>
EOL;
}
?>
