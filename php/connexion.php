<?php
include_once "./config_db.php";

$conn->beginTransaction();

$sql = "SELECT users.username FROM users WHERE users.username LIKE :user OR users.email LIKE :user AND users.password LIKE :password";
$query = $conn->prepare($sql);
$query->bindValue(":user", $_POST['user']);
$query->bindValue(":password", $_POST['password']);

if($query->execute()){
    $conn->commit();
}
else{
    $conn->rollBack();
}

$user_info = $query->fetch();

if($user_info == null){
    header('Location: ../html/connexion.html?error=connexion');
}
else {
    header('Location: ../html/mydrive.php?user='.$user_info['username']);
}
