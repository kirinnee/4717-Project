<?php
return function ($movie, $tickets) {
    echo <<<EOL
    <div class="seating">
        <h2>Select your seats</h2>
        <div class="seats">
            <div class="row">
                <div class="seat">1</div>
                <div class="seat">2</div>
                <div class="seat">3</div>
                <div class="seat">4</div>
                <div class="seat">5</div>
                <div class="seat empty"></div>
                <div class="seat">6</div>
                <div class="seat">7</div>
                <div class="seat">8</div>
                <div class="seat">9</div>
                <div class="seat">10</div>
            </div>
            <div class="row">
                <div class="seat">11</div>
                <div class="seat">12</div>
                <div class="seat">13</div>
                <div class="seat">14</div>
                <div class="seat">15</div>
                <div class="seat empty"></div>
                <div class="seat">16</div>
                <div class="seat">17</div>
                <div class="seat">18</div>
                <div class="seat">19</div>
                <div class="seat">20</div>
            </div>
            <div class="row">
                <div class="seat">21</div>
                <div class="seat">22</div>
                <div class="seat">23</div>
                <div class="seat">24</div>
                <div class="seat">25</div>
                <div class="seat empty"></div>
                <div class="seat">26</div>
                <div class="seat">27</div>
                <div class="seat">28</div>
                <div class="seat">29</div>
                <div class="seat">30</div>
            </div>
            <div class="row">
                <div class="seat">31</div>
                <div class="seat">32</div>
                <div class="seat">33</div>
                <div class="seat">34</div>
                <div class="seat">35</div>
                <div class="seat empty"></div>
                <div class="seat">36</div>
                <div class="seat">37</div>
                <div class="seat">38</div>
                <div class="seat">39</div>
                <div class="seat">40</div>
            </div>
            <div class="row">
                <div class="seat">41</div>
                <div class="seat">42</div>
                <div class="seat">43</div>
                <div class="seat">44</div>
                <div class="seat">45</div>
                <div class="seat">46</div>
                <div class="seat empty"></div>
                <div class="seat">47</div>
                <div class="seat">48</div>
                <div class="seat">49</div>
                <div class="seat">50</div>
                <div class="seat">51</div>
                <div class="seat">52</div>
            </div>
             <div class="row">
                <div class="seat">53</div>
                <div class="seat">54</div>
                <div class="seat">55</div>
                <div class="seat">56</div>
                <div class="seat">57</div>
                <div class="seat empty"></div>
                <div class="seat empty"></div>
                <div class="seat empty"></div>
                <div class="seat">58</div>
                <div class="seat">59</div>
                <div class="seat">60</div>
                <div class="seat">61</div>
                <div class="seat">62</div>
            </div>
             <div class="row">
                <div class="seat">63</div>
                <div class="seat">64</div>
                <div class="seat">65</div>
                <div class="seat empty"></div>
                <div class="seat empty"></div>
                <div class="seat empty"></div>
                <div class="seat empty"></div>
                <div class="seat empty"></div>
                <div class="seat">66</div>
                <div class="seat">67</div>
                <div class="seat">68</div>
            </div>

        </div>
        <div class="legend-bar">
            <h3>Legend</h3>
            <div class="legends">
                <div class="legend">
                    <div class="seat"></div>
                    <div>Available</div>
                </div>
                <div class="legend">
                    <div class="seat taken"></div>
                    <div>Not Available</div>
                </div>
                <div class="legend">
                    <div class="seat picked"></div>
                    <div>Selected</div>
                </div>
            </div>
        </div>

        <div class="allocation">
            <div class="value">Unallocated Seats: 0</div>
        </div>
<div class="selectors">
EOL;
    $ttEle = require("./lib/ticket_selector/index.php");
    foreach ($tickets as $tt) {
        $ttEle($tt);
    }
    echo <<<EOL
</div>
    <div class="pay">

        <div class="button">
           <input type="submit" value="PROCEED TO PAYMENT">
        </div>
        <div class="cost">
            Total Cost: $ 0.00
        </div>

    </div>
EOL;

}
?>
