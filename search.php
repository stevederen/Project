<?php
$dir = "/files";

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if($file == $_POST['search']){
                echo('<a href="'.$dir . $file.'">'. $file .'</a>'."\n");
            }
        }
        closedir($dh);
    }
}
?>