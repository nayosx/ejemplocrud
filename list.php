<?php
session_start();
require_once('./core/data/TestDB.class.php');
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE) {
    $db = TestDB::getInstance();
    $query = "SELECT *  FROM usuario;";
    $listaDeUsuarios = $db->result($query);
?>
<?php include_once('./template/header.php'); ?>
    <div class="container first-container">
        <div class="row">
            <div class="col-md-12 text-right mb-1">
                <a href="add.php" class="btn btn-default">Agregar usuario</a>
            </div>
            <div class="col-md-12">
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
                                <a href="app/userDelete.php?id=<?php echo $usuario->id;?>" class="btn btn-sm btn-danger <?php echo ($_SESSION['id'] === $usuario->id) ? 'disabled' : ''?>">Eliminar</a>
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
<?php include_once('./template/footer.php'); ?>
<?php
} else{
    header('Location: index.php');
}
?>

