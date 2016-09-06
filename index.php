<?php
session_start();
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){
    header('Location: pages/access.php');
    die();
} else{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="assets/plugins/boostrap/css/bootstrap.min.css" type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="controller/login.php" method="POST">
                        <div class="form-group">
                            <label class="control-label">Usuario</label>
                            <input type="text" class="form-control" name="username"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Contraseña</label>
                            <input type="password" class="form-control" name="password"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
} ?>

