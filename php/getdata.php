<?php
// $test = unserialize(urldecode($_POST));

if (isset($test) && !empty($test)) {
    $path = "../storage/" . $test . "/";
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

            $file = array('name' => $scan, 'type' => pathinfo($path . $scan, PATHINFO_EXTENSION), "url" => "http://localhost/mydrive/" . substr($path, 3) . $scan);

            array_push($files, $file);
        }
    }
}

header('Content-Type: application/json');
echo json_encode($files);
