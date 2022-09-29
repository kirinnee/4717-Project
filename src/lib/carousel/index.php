<?php
return function(){
    echo <<<EOL
    <div class='carousel'>
    <div class='pre' onclick="moveLeft()">
        <div class="up">
        </div>
        <div class="down">
        </div>
        <div class="line">
        </div>
    </div>
    <div class='slider'>
        <div class='real' id='real'>
            <div class="slide">
                1
            </div>
            <div class="slide">
                2
            </div>
            <div class="slide">
                3
            </div>
            <div class="slide">
                4
            </div>
            <div class="slide">
                5
            </div>
        </div>
        <div class="control">
            <div class="radio" onclick="moveTo(0)"></div>
            <div class="radio" onclick="moveTo(1)"></div>
            <div class="radio" onclick="moveTo(2)"></div>
            <div class="radio" onclick="moveTo(3)"></div>
            <div class="radio" onclick="moveTo(4)"></div>
        </div>
    </div>
    

    <div class='post' onclick="moveRight()">
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