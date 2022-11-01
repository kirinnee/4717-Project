<?php
return function($id, $class, $label, $attr, $name, $type) {
    echo <<<EOL
    <div class="generic-input-holder $class" id="$id">
        <div class="generic-label">$label</div>
        <div class="generic-input">
            <input type="$type" name="$name" class="generic-input"  $attr >
            <div class="generic-error">no error</div>
        </div>
        <div class="generic-check">✅</div>
    </div>
EOL;
}
?>
