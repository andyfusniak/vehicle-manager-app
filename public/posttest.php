<?php
ob_start();
var_dump($_POST);
$content = ob_get_contents();
ob_end_clean();
$f = fopen("/var/www/serenityleisure/uploads/file.txt", "w");
fwrite($f, $content);
fclose($f); 
