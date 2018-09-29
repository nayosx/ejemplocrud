<?php
session_start();
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){ ?>
<?php include_once('./template/header.php'); ?>
    <div class="container first-container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1>Agregar usuario</h1>
                <div class="well">
                    <form action="../app/userAdd.php" method="POST">
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
<?php include_once('./template/footer.php'); ?>
<?php
} else{
    header('Location: index.php');
    die();
}
?>
        