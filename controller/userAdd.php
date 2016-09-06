<?php
session_start();
require '../core/data/MyDatabase.php';
if (isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $db = new MyDatabase();
    $query = "INSERT INTO usuario (username, password) VALUES (:user, :pass) ;";
    $params = array(
        ':user' => $_POST['username'],
        ':pass' => $_POST['password']
    );
    $usuario = $db->execute($query, $params);
    if($usuario){
        header('Location: ../pages/user/list.php');
        die();
    } else{
        echo "No se a podido crear el usuario";
    }
} else{
    header('Location: ../index.php');
    die();
}
