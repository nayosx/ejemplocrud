<?php
session_start();
require_once '../core/data/TestDB.class.php';

$username = $_POST['username'];
$password = $_POST['password'];
$msgError = '?error=';
$redirectTo = 'Location: ';
$actualUser = '&user=';

if($username != "" && $password != ""){
    $db = TestDB::getInstance();
    $query = "SELECT * FROM usuario WHERE username = :user";
    $params = array(
        ':user' => $username
    );
    $usuario = $db->row($query, $params);
    $actualUser .= urlencode($username);
    if(is_object($usuario) && !empty($usuario)){
        if(md5($password) === $usuario->password){
            $_SESSION['valid'] = TRUE;
            $_SESSION['id'] = $usuario->id;
            $_SESSION['username'] = $usuario->username;
            $redirectTo .= '../eat.php';
        }else {
            $msgError .= urlencode('Contraseña incorrecta');
            $redirectTo .= '../index.php'.$msgError . $actualUser;
        }
    }else {
        $msgError .= urlencode('Usuario no valido');
        $redirectTo .= '../index.php'.$msgError . $actualUser;
    }
} else {
    $msgError .= urlencode('Se necesitan credenciales para ingresar');
    $redirectTo .= '../index.php'.$msgError;
}
header($redirectTo);



