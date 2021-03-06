<?php
if (isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['id']) && !empty($_GET['id']) && $_GET['id'] == "278d068a-3d2c-4e78-9953-38cc906fa8e4") {
    $user = $_GET['user'];
} else {
    header("Location: ./404.php?error=nouser");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/main.min.css">
    <title>MyDrive</title>
</head>

<body>
    <header class="lign-1">
        <div id="restart" class="logo">
            <img class="logo_pic mr-1 ml-3" src="../images/logo.svg" alt="logo">
            <h1 class="heading-2 mr-3" onclick="getData()">MyDrive</h1>
        </div>
        <div class="searchbox">
            <input class="ml-1 mr-1 texting-1" type="text" placeholder="Rechercher sur MyDrive">
            <button type="submit" onclick="searchFiles()"><i class="fas fa-search icon-2 mr-1 ml-1"></i></button>
        </div>
        <div class="profil ml-1 mr-3">
            <p class="texting-2"><?= $user ?></p>
            <i class="fas fa-user icon-1 signinicon ml-1"></i>
        </div>
    </header>

    <main class="userdrive">

        <div id="addnewfolder" class="d-none">
            <i class="fas fa-times" onclick="showNewFolder()"></i>
            <input class="texting-1 p-1 mb-2" type="text" placeholder="Nom du dossier" id="newfoldername">
            <button class="texting-1 p-1" type="button" onclick="addNewFolder()">Créer</button>
        </div>

        <div class="userdrive_menu lign-2">

            <div class="userdrive_menu_btn mt-3 ml-1 mr-1" onclick="showNewFolder()">
                <img src="../images/icon/newfolder.png" alt="nouveau dossier">
                <p class="texting-1 ml-1">Nouveau dossier</p>
            </div>

            <input type="file" name="file" id="file" class="inputfile" onchange="addFile()" />
            <label for="file">
                <div class="userdrive_menu_btn mt-3 ml-1 mr-1">
                    <img src="../images/icon/addfile.png" alt="ajouter un fichier">
                    <p class="texting-1 ml-1">Ajouter un fichier</p>
                </div>
            </label>

            <div class="userdrive_menu_btn mt-3 ml-1 mr-1">
                <img src="../images/icon/share.png" alt="partager">
                <p class="texting-1 ml-1">Partage</p>
            </div>

        </div>

        <div class="userdrive_data">

            <div id="ariane" class="userdrive_data_ariane texting-1 p-3 m-1">
                <p><i class="fas fa-chevron-right"></i> <span>MyDrive</span> </p>
            </div>

            <div id="storage" class="userdrive_data_storage p-3">


            </div>
        </div>

    </main>
    <script src="../js/mydrive.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>