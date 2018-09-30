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
                            <input type="text" class="form-control" name="username" value="<?php if(isset($_GET['user'])) { echo $_GET['user']; }?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" required/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>

                    <?php if(isset($_GET['error'])) {?>
                    <div class="alert alert-danger">
                        <?php echo $_GET['error'] ?>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
<?php include_once('./template/footer.php'); ?>
<?php
} 
?>