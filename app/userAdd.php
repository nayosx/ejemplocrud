<?php
session_start();
require '../core/data/TestDB.class.php';
if (isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $db = TestDB::getInstance();
    $query = "INSERT INTO usuario (username, password) VALUES (:user, :pass) ;";
    $params = array(
        ':user' => $_POST['username'],
        ':pass' => md5($_POST['password'])
    );
    
    $usuario = $db->execute($query, $params);
    if($usuario){
        header('Location: ../list.php');
        die();
    } else{
        echo "No se a podido crear el usuario";
    }
} else{
    header('Location: ../');
    die();
}

