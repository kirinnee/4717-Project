<?php
return function($title, $css, $js) {
    echo <<<EOL
<title>$title</title>
<meta charset="utf-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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

}

?>
