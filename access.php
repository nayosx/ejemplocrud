<?php
session_start();
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){ ?>
<?php include_once('./template/header.php'); ?>
        <div class="container first-container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Acceso consedido</h1>
                </div>
                <div class="col-md-12">
                    <div class="col-xs-4">
                        <a href="list.php" class="btn btn-block btn-info">Lista de usuarios</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="add.php" class="btn btn-block btn-success">Agregar usuario</a>
                    </div>
                    <div class="col-xs-4">
                        <a href="logout.php" class="btn btn-block btn-danger">Salir de la sesión</a>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('./template/footer.php'); ?>
<?php
} else{
    header('Location: index.php');
    die();
}
?>


