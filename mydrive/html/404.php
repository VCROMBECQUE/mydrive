<?php
switch ($_GET['error']) {
    case 'nouser':
        $msg = "Vous devez vous connecter pour accéder à votre MyDrive.";
        break;

    case 'connexion':
        $msg = "Erreur lors de la saisie de votre identifiant et mot de passe.";
        break;

    default:
        $msg = "Une erreur inconnu est survenue.";
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/main.min.css">
    <title>404</title>
</head>

<body>
    <main class="errorbox">
        <h1 class="heading-2 mb-2"><?= $msg ?></h1>
        <a class="heading-2" href="./connexion.html">Retour à la page de connexion</a>
    </main>
</body>

</html>