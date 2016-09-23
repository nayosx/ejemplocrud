<?php
session_start();
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acciones</title>
        <link rel="stylesheet" href="../assets/plugins/boostrap/css/bootstrap.min.css" type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1 class="text-center">Acceso consedido</h1>
                <div class="col-md-12">
                    <div class="col-xs-4">
                        <a href="user/list.php" class="btn btn-block btn-info">Lista de usuarios</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="user/add.php" class="btn btn-block btn-success">Agregar usuario</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="../controller/logout.php" class="btn btn-block btn-danger">Salir de la sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
} else{
    header('Location: ../index.php');
    die();
}
?>


