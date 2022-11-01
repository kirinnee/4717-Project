<?php
return function($title, $css, $js, $defered) {
    echo <<<EOL
<title>$title</title>
<meta charset="utf-8">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400&family=Raleway:wght@100;200;300;400&display=swap" rel="stylesheet">

<link rel="stylesheet" href="index.css">
EOL;
    foreach ($css as $v) {
        echo <<<EOL
        <link rel="stylesheet" href="lib/$v/index.css">
EOL;
    }
    foreach ($js as $v) {
        echo <<<EOL
        <script src="lib/$v/index.js"></script>
EOL;
    }
    foreach ($defered as $v) {
        echo <<<EOL
        <script defer src="lib/$v/index.js"></script>
EOL;
    }
}

?>
