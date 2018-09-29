<?php
session_start();
require '../../core/data/MyDatabase.php';
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){
    $db = new MyDatabase();
    $query = "SELECT *  FROM usuario;";
    $listaDeUsuarios = $db->result($query);
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
                <div class="col-md-12">
                    <a href="../access.php">Volver</a> | <a href="add.php">Agregar usuario</a> 
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listaDeUsuarios as $usuario){
                            ?>
                            <tr>
                                <td><?php echo $usuario->id;?></td>
                                <td><?php echo $usuario->username;?></td>
                                <td><?php echo $usuario->password;?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $usuario->id;?>" class="btn btn-sm btn-info">Editar</a>
                                    <a href="../../app/userDelete.php?id=<?php echo $usuario->id;?>" class="btn btn-sm btn-danger">Eliminar</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
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


