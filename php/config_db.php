<?php 
$servername = 'localhost';
$username = 'root';
$password = '';
$database  = 'my_drive';
$charset = 'utf8';
$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";

try {
    $conn = new PDO($dsn, $username, $password);
} catch (\Throwable $error) {
    echo "Erreur de connexion à la base de donnée !";
    die();
}
?>