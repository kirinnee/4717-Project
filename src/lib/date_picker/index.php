<?php
return function(){
    echo <<<EOL
<div class="date-picker-container">
    <div class="date-picker">
        <div class="date chosen normal"  option="1" onclick="chooseDate(1)">
            <div>ALL WEEK</div>
        </div>
        <div class="date normal" option="2" onclick="chooseDate(2)">
            <div>TODAY</div>
        </div>
        <div class="date date-day" option="3" onclick="chooseDate(3)">
            <div class="actual-date">
            <div>30 SEP</div>
                
            </div>
            <div class="day">
                <div>FRI</div>
            </div>
        </div>
        <div class="date date-day" option="4" onclick="chooseDate(4)">
        <div class="actual-date">
            <div>1 OCT</div>
                
            </div>
            <div class="day">
                <div>SAT</div>
            </div>
        </div>
        <div class="date date-day" option="5" onclick="chooseDate(5)">
            <div class="actual-date">
            <div>2 OCT</div>
                
            </div>
            <div class="day">
                <div>SUN</div>
            </div>
        </div>
        <div class="date date-day" option="6" onclick="chooseDate(6)">
            <div class="actual-date">
            <div>3 OCT</div>
                
            </div>
            <div class="day">
                <div>MON</div>
            </div>
        </div>
        <div class="date date-day" option="7" onclick="chooseDate(7)">
             <div class="actual-date">
            <div>4 OCT</div>
                
            </div>
            <div class="day">
                <div>TUE</div>
            </div>
        </div>

    </div>
</div>
EOL;
}
?>