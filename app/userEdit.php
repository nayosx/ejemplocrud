<?php
session_start();
require '../core/data/MyDatabase.php';
if (isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $id = (isset($_POST['idusuario'])) ? $_POST['idusuario']: 0;
    if($id > 0){
        $db = new MyDatabase();
        $query = "UPDATE usuario SET username = :user, password = :pass WHERE id = :id ;";
        $params = array(
            ':id' => $id,
            ':user' => $_POST['username'],
            ':pass' => $_POST['password']
        );
        
        $isUpdate = $db->execute($query, $params);
        if($isUpdate){
            header('Location: ../pages/user/list.php');
            die();
        } else{
            echo "No se a podido actualizar el usuario";
            die();
        }
        
    } else {
        echo "No se puede actualizar por favor comprueba tus parametros";
        die();
    }
} else{
    header('Location: ../index.php');
    die();
}