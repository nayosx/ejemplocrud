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
                _updateUser($db, $id);
            break;
            case PASSWORD:
                _updatePassword($db, $id);
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

function _updateUser($db, $id) {
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

function _updatePassword($db, $id) {
    $msg = '';
    $actual = $_POST['actual'];
    $new = $_POST['new'];

    $query = "SELECT password FROM usuario WHERE id = :id ;";
    $params = array(
        ':id' => $id
    );
    
    $usuario = $db->row($query, $params);
    
    if(is_object($usuario) && !empty($usuario)) {
        if(md5($actual) === $usuario->password) {
            if(md5($new) !== $usuario->password) {
                $query = "UPDATE usuario SET password = :pass WHERE id = :id ;";
                $params = array(
                    ':id' => $id,
                    ':pass' => md5($new)
                );
                $isUpdate = $db->execute($query, $params);
                if($isUpdate){
                    header('Location: ../list.php');
                    die();
                } else{
                    $msg = 'No se a podido actualizar el la contraseña';
                }
            } else {
                $msg = 'La nueva contraseña no tiene que ser igual a la anterior';
            }
        } else {
            $msg = 'La contraseña actual no es valida';
        }
    } else {
        header('Location: ../list.php');
        die();
    }
    $msg = urlencode($msg);
    header('Location: ../edit.php?id='.$id.'&errorPassword=' . $msg);
}