<?php
$input = ['file' => $_FILES['file'], 'path' => $_POST['path']];

$path = "../storage/" . $input['path'] . "/" . $input['file']['name'];
$uploadOk = 1;

$type = strtolower(pathinfo($path, PATHINFO_EXTENSION));

if (file_exists($path)) {
     echo "Désolé, le fichier existe déjà.";
    $uploadOk = 0;
}

if ($input['file']['size'] > 500000) {
     echo "Désolé, votre fichier est trop volumineux.";
    $uploadOk = 0;
}

if ($type != "jpg" && $type != "png" && $type != "gif" && $type != "docx" && $type != "xlsx" && $type != "pptx" && $type != "pdf" && $type != "txt" && $type != "mp3" && $type != "avi") {
     echo "Désolé, l'extension de votre fichier n'est pas accepté.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
     echo "Désolé, votre fichier ne peut pas être téléverser.";
} else {
    if (move_uploaded_file($input['file']['tmp_name'], $path)) {
         echo "Le fichier " . htmlspecialchars(basename($input["file"]["name"])) . " a bien été téléversé.";
    } else {
         echo "Désolé, il y a eu une erreur lors du téléversement.";
    }
}