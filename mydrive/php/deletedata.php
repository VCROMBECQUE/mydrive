<?php
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input) && !empty($input)) {
    $path = "../storage/" . $input['path'] . "/" . $input['datatodel'];
    
    if(pathinfo($input['datatodel'], PATHINFO_EXTENSION) != "") {
        unlink($path);
    }
    else {
        rmdir_recursive($path);
    }
} 

function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}