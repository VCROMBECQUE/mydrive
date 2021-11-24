<?php
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input) && !empty($input)) {

    $oldpath = "../storage/" . $input['path'] . "/" . $input['datatoren'];
    
    if(pathinfo($input['datatoren'], PATHINFO_EXTENSION) != "") {
        $path = "../storage/" . $input['path'] . "/" . $input['newname'] . "." . strtolower(pathinfo($input['datatoren'], PATHINFO_EXTENSION));
    }
    else {
        $path = "../storage/" . $input['path'] . "/" . $input['newname'];
    }

    rename($oldpath, $path);
} 