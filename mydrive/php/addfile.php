<?php
$input = ['file' => $_FILES['file'], 'path' => $_POST['path']];

$path = "../storage/" . $input['path'] . "/" . $input['file']['name'];
$uploadOk = 1;

$type = strtolower(pathinfo($path, PATHINFO_EXTENSION));

if (file_exists($path)) {
     $msg = "Désolé, le fichier existe déjà.";
     $uploadOk = 0;
}

// if ($uploadOk && ($input['file']['size'] > 50000000)) {
//      $msg = "Désolé, votre fichier est trop volumineux.";
//      $uploadOk = 0;
// }

if ($uploadOk && ($type != "jpg" && $type != "png" && $type != "gif" && $type != "docx" && $type != "xlsx" && $type != "pptx" && $type != "pdf" && $type != "txt" && $type != "mp3" && $type != "avi")) {
     $msg = "Désolé, l'extension de votre fichier n'est pas accepté.";
     $uploadOk = 0;
}

if ($uploadOk == 0) {
     $msg .= "\nVotre fichier ne peut pas être téléverser.";
} else {
     if (move_uploaded_file($input['file']['tmp_name'], $path)) {
          $msg = "Le fichier " . htmlspecialchars(basename($input["file"]["name"])) . " a bien été téléversé.";
     } else {
          $msg = "Désolé, il y a eu une erreur lors du téléversement.";
     }
}

header('Content-Type: application/json');
echo json_encode($msg);