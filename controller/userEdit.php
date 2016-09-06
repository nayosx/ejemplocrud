<?php
session_start();
require '../core/data/MyDatabase.php';
if (isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $id = (isset($_POST['id'])) ? $_POST['id'] : 0;
    if ($id > 0) {
        $db = new MyDatabase();
        $query = "UPDATE usuario SET username = :user, password = :pass WHERE id = :id ;";
        $params = array(
            ':id' => $id,
            ':user' => $_POST['username'],
            ':pass' => $_POST['password']
        );
        $usuario = $db->execute($query, $params);
        if($usuario){
            header('Location: ../pages/user/list.php');
            die();
        } else{
            echo "No se a podido eliminar al usuario";
        }
    } else {
        header('Location: list.php');
        die();
    }
} else{
    header('Location: ../index.php');
    die();
}
