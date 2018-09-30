<?php
session_start();
require '../core/data/TestDB.class.php';
if (isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $id = (isset($_GET['id'])) ? $_GET['id']: 0;
    if($id > 0 && $_SESSION['id'] != $id){
        $db = TestDB::getInstance();
        $query = "DELETE FROM usuario WHERE id = :id ;";
        $params = array(':id' => $id);
        
        $isDelete = $db->execute($query, $params);
        if($isDelete){
            header('Location: ../list.php');
            die();
        } else{
            echo "No se puede eliminar el usuario";
            die();
        }
    } else {
        echo "No se puede eliminar el usuario";
        die();
    }
} else{
    header('Location: ../');
    die();
}

