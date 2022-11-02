<?php
return function ($movies, $id) {

    $size = count($movies);
    echo <<<EOL
    <script>
        const c_$id = carousel($size, "$id");
    </script>
    <div class='carousel'>
    <div class='pre' onclick="c_$id.moveLeft()">
        <div class="up">
        </div>
        <div class="down">
        </div>
        <div class="line">
        </div>
    </div>
    <div class='slider' id="slider-$id">
        <div class='real' id='$id'>
EOL;
    foreach ($movies as $m) {
        echo <<<EOL
<div class="slide">
      <img src="$m->image1" alt="Image" />
      <div class="metadata">
        <div class="header">$m->name</div>
        <div class="content">$m->desc</div>
        <div class="action-bar">
            <div class="button-wrapper">
                <a class="button" href="shows.php?id=$m->id">WATCH NOW</a>
            </div>
        </div>

    </div>
</div>
EOL;
    }
    echo <<<EOL
        </div>
        <div class="control">
EOL;

    foreach ($movies as $key => $value) {
        echo <<<EOL
    <div class="radio" onclick="c_$id.moveTo($key)" radio-index="$key">
        <div class="radio-display-inner">

        </div>
         <div class="radio-display-inner-colored">

        </div>
        <div class="radio-display-outer">

        </div>
    </div>
EOL;
    }
    echo <<<EOL
        </div>
    </div>
    <script>
        c_$id.init();
    </script>


    <div class='post' onclick="c_$id.moveRight()">
    <div class="up">
    </div>
    <div class="down">
    </div>
    <div class="line">
    </div>
    </div>
</div>
EOL;
}
?>
