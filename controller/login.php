<?php
session_start();
require '../core/data/MyDatabase.php';

$username = $_POST['username'];
$password = $_POST['password'];

if($username != "" && $password != ""){
    $db = new MyDatabase();
    $query = "SELECT * FROM usuario WHERE username = :user";
    $params = array(
        ':user' => $username
    );
    $usuario = $db->row($query, $params);
    if(is_object($usuario) && !empty($usuario)){
        
        if($password == $usuario->password){
            $_SESSION['valid'] = TRUE;
            header('Location: ../pages/access.php');
            die();
        }else {
            header('Location: ../pages/denied.php');
            die();
        }
        
    }else {
        header('Location: ../pages/denied.php');
        die();
    }
} else {
    header('Location: ../index.php');
    die();
}




