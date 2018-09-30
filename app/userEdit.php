<?php
session_start();
require '../core/data/TestDB.class.php';
define('EDITAR', 1);
define('PASSWORD', 2);

if (isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $id = (isset($_POST['idusuario'])) ? $_POST['idusuario']: 0;
    if($id > 0){
        $db = TestDB::getInstance();
        switch($_GET['action']) {
            case EDITAR:
                updateUser($db, $id);
            break;
            case PASSWORD;
                updatePassword($db, $id);
            break;
        }
    } else {
        echo "No se puede actualizar por favor comprueba tus parametros";
        die();
    }
} else{
    header('Location: ../');
    die();
}


function updateUser($db, $id) {
    $query = "UPDATE usuario SET username = :user WHERE id = :id ;";
    $params = array(
        ':id' => $id,
        ':user' => $_POST['username']
    );
    $isUpdate = $db->execute($query, $params);
    if($isUpdate){
        header('Location: ../list.php');
        die();
    } else{
        $msg = urlencode('No se a podido actualizar el usuario');
        header('Location: ../edit.php?errorUser=' . $msg);
        die();
    }
}

function updatePassword($db, $id) {
    $msg = '';
    if($_POST['actual'] !== $_POST['new']) {

        echo 'no deberia hacer esto';
        /*$query = "UPDATE usuario SET password = :pass WHERE id = :id ;";
        $params = array(
            ':id' => $id,
            ':pass' => md5($_POST['new'])
        );
        $isUpdate = $db->execute($query, $params);
        if($isUpdate){
            header('Location: ../list.php');
            die();
        } else{
            $msg = 'No se a podido actualizar el la contraseña';
        }*/
    } else {
        $msg = 'La contraseña tiene que ser distinta a la actual';
    }
    $msg = urlencode($msg);
    header('Location: ../edit.php?errorPassword=' . $msg);
}