<?php
    $cc = function() {
        return conn();
    };
    $genreRepo = new GenreRepo($cc);
?>
<div class="search-holder">
    <input id="search" class="search" placeholder="Search for show..."/>
    <select class="selector" id="selector">
        <option value="0">All</option>
        <?php
            $genres = $genreRepo->getAll();
            foreach($genres as  $v) {
                echo "<option value='$v'>$v</option>";
            }
        ?>

    </select>
</div>
