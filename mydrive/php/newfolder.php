<?php 

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input) && !empty($input)) {
    $path = "../storage/" . $input['path'] . "/" . $input['foldername'];
    mkdir($path);
} 