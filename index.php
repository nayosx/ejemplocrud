<?php
session_start();
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){
    header('Location: pages/access.php');
    die();
} else{
?>
<?php include_once('./template/header.php'); ?>
        <div class="container first-container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h3 class="text-center">Bienvenido</h3>
                    <form action="app/login.php" method="POST">
                        <div class="form-group">
                            <label class="control-label">Usuario</label>
                            <input type="text" class="form-control" name="username" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" required/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php include_once('./template/footer.php'); ?>
<?php
} 
?>