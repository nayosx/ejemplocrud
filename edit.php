<?php
session_start();
require './core/data/TestDB.class.php';
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){
    $id = (isset($_GET['id'])) ? $_GET['id'] : 0;
    if($id > 0){
        $db = TestDB::getInstance();
        $query = "SELECT id, username FROM usuario WHERE id = :id ;";
        $params = array(
            ':id' => $id
        );
        
        $usuario = $db->row($query, $params);
        
        if(!is_object($usuario) && empty($usuario)){
            echo "No existe el usuario";
            die();
        }
        
    } else{
        header('Location: list.php');
        die();
    }
?>
<?php include_once('./template/header.php'); ?>
    <div class="container first-container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1>Editar usuario</h1>
                <div class="well">
                    <form action="app/userEdit.php?action=1" method="POST">
                        <div class="form-group">
                            <label class="control-label">Nombre de usuario</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $usuario->username;?>" required />
                        </div>
                        <input type="hidden" name="idusuario" value="<?php echo $usuario->id;?>" />
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="list.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                    <?php if(isset($_GET['errorUser'])) {?>
                    <div class="alert alert-danger">
                        <?php echo $_GET['errorUser'] ?>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1>Actualizar contrase&ntilde;a</h1>
                <div class="well">
                    <form action="app/userEdit.php?action=2" method="POST">
                        <div class="form-group">
                            <label class="control-label">Contrase&ntilde;a actual</label>
                            <input type="text" class="form-control" name="actual" required />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nueva contrase&ntilde;a</label>
                            <input type="text" class="form-control" name="new" required />
                        </div>
                        <input type="hidden" name="idusuario" value="<?php echo $usuario->id;?>" />
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="list.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                    <?php if(isset($_GET['errorPassword'])) {?>
                    <div class="alert alert-danger">
                        <?php echo $_GET['errorPassword'] ?>
                    </div>
                    <?php }?>
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
