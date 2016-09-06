<?php
session_start();
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de usuarios</title>
        <link rel="stylesheet" href="../../assets/plugins/boostrap/css/bootstrap.min.css" type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h1>Agregar usuario</h1>
                    <div class="well">
                        <form action="../../controller/userAdd.php" method="POST">
                            <div class="form-group">
                                <label class="control-label">Nombre de usuario</label>
                                <input type="text" class="form-control" name="username"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contraseña del usuario</label>
                                <input type="text" class="form-control" name="password"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="../access.php" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php 
} else{
    header('Location: ../../index.php');
    die();
}