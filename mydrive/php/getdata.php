<?php

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input) && !empty($input)) {

    $path = "../storage/". $input . "/";

} else {
    $path = "../storage/";
}

$scans = scandir($path, SCANDIR_SORT_DESCENDING);
$files = array();

foreach ($scans as $scan) {
    if ($scan != '.' && $scan != '..') {
        if (is_dir($path . $scan)) {

            $file = array('name' => $scan, 'type' => 'folder', "url" => "http://localhost/mydrive/" . substr($path, 3) . $scan);

            array_unshift($files, $file);
        } else if (is_file($path . $scan) && preg_match("#\.(jpg|png|gif|docx|xlsx|pptx|pdf|txt|mp3|avi)$#", strtolower($scan))) {

            $file = array('name' => $scan, 'type' => pathinfo($path . $scan, PATHINFO_EXTENSION), "url" => "../" . substr($path, 3) . $scan);

            array_push($files, $file);
        }
    }
}

$file = array('name' => substr($path, 11), 'type' => 'current', "url" => "http://localhost/mydrive/" . substr($path, 3));
array_unshift($files, $file);
header('Content-Type: application/json');
echo json_encode($files);
