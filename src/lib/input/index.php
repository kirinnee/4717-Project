<?php
return function($id, $class, $label, $attr, $name, $type) {
    echo <<<EOL
    <div class="generic-input-holder $class" id="$id">

        <div class="generic-input">
            <div class="generic-label">$label</div>
            <div class="generic-bar">
                <input type="$type" name="$name" class="generic-input"  $attr ><div class="generic-check">✅</div>
            </div>

            <div class="generic-error">no error</div>
        </div>

    </div>
EOL;
}
?>
