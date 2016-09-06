<?php
session_start();
require '../../core/data/MyDatabase.php';
if (isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $id = (isset($_GET['id'])) ? $_GET['id'] : 0;
    if ($id > 0) {
        $db = new MyDatabase();
        $query = "SELECT * FROM usuario WHERE id = :id;";
        $params = array(':id' => $id);
        $usuario = $db->row($query, $params);
    } else {
        header('Location: list.php');
        die();
    }
?>
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
                        <h1>Editar usuario</h1>
                        <?php if (is_object($usuario) && !empty($usuario)) { ?>
                            <div class="well">
                                <form action="../../controller/userEdit.php" method="POST">
                                    <div class="form-group">
                                        <label class="control-label">Nombre de usuario</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo $usuario->username; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Contraseña del usuario</label>
                                        <input type="text" class="form-control" name="password" value="<?php echo $usuario->password; ?>"/>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>" />
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="list.php" class="btn btn-danger">Cancelar</a>
                                    </div>
                                </form>
                            </div>

                        <?php
                        } else {
                            echo '<h1>No se a encontrado información del usuario</h1>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: ../../index.php');
    die();
}