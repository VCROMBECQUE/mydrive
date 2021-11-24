<?php
include_once "./config_db.php";

$conn->beginTransaction();

$sql = "SELECT users.uuid, users.username FROM users WHERE ( users.username LIKE :user OR users.email LIKE :user ) AND users.password LIKE :password";
$query = $conn->prepare($sql);
$query->bindValue(":user", $_POST['user']);
$query->bindValue(":password", $_POST['password']);


if($query->execute()){
    $conn->commit();
}
else{
    $conn->rollBack();
}

$user_info = $query->fetchAll();

if($user_info == null){
    header('Location: ../html/404.php?error=connexion');
}
else {
    header('Location: ../html/mydrive.php?id='.$user_info[0]['uuid'].'&user='.$user_info[0]['username']);
}
