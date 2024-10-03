<?php
// session_start(); 
include "include/encabezado.php";
include "../Servidor/conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['apat']) || empty($_POST['amat']) || empty($_POST['correo']) || empty($_POST['contra']) || empty($_POST['tel']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
        $alert = '<p class"error">Todo los campos son requeridos</p>';
    } else {
        $idusuario = $_GET['id'];
        $nombre = $_POST['nombre'];
        $apat = $_POST['apat'];
        $amat = $_POST['amat'];
        $correo = $_POST['correo'];
        $contra = $_POST['contra'];
        $tel = $_POST['tel'];
        $usuario = $_POST['usuario'];
        $rol = $_POST['rol'];

        $sql_update = mysqli_query($conexion, "UPDATE usuarios SET NomUsu= '$nombre', ApaUsu= '$apat', AmaUsu= '$amat', Correo = '$correo' , Contra = '$contra', telefono = '$tel', idtipo = $rol WHERE idusuario = $idusuario");
        $alert = '<p>Usuario Actualizado</p>';
        header("Location:usuarios.php");
    }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location:usuarios.php");
}
$idusuario = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario= $idusuario");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("Location:usuarios.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $idcliente = $data['idusuario'];
        $nombre = $data['NomUsu'];
        $apat = $data['ApaUsu'];
        $amat = $data['AmaUsu'];
        $correo = $data['Correo'];
        $contra = $data['Contra'];
        $tel = $data['telefono'];
        $rol = $data['idtipo'];
    }
}
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 m-auto">
            <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idusuario; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre: </label>
                    <input type="text" placeholder="Ingrese nombre" class="form-control" name="nombre" id="nombre"
                        value="<?php echo $nombre; ?>" readonly>

                </div>

                <div class="form-group">
                    <label for="nombre">Apellido Paterno: </label>
                    <input type="text" placeholder="Ingrese Apellido Paterno" class="form-control" name="apat" id="apat"
                        value="<?php echo $apat; ?>" readonly>

                </div>

                <div class="form-group">
                    <label for="nombre">Apellido Materno: </label>
                    <input type="text" placeholder="Ingrese Apellido Materno" class="form-control" name="amat" id="amat"
                        value="<?php echo $amat; ?>" readonly>

                </div>

                <div class="form-group">
                    <label for="correo">Correo: </label>
                    <input type="text" placeholder="Ingrese correo" class="form-control" name="correo" id="correo"
                        value="<?php echo $correo; ?>">

                </div>
                <div class="form-group">
                    <label for="usuario">Contraseña:</label>
                    <input type="text" placeholder="Ingrese contraseña" class="form-control" name="contra" id="contra"
                        value="<?php echo $contra; ?>">

                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select name="rol" id="rol" class="form-control">
                        <option value="1" <?php
                                            if ($rol == 1) {
                                                echo "selected";
                                            }
                                            ?>>Administrador</option>
                        <option value="2" <?php
                                            if ($rol == 2) {
                                                echo "selected";
                                            }
                                            ?>>Supervisor</option>
                        <option value="3" <?php
                                            if ($rol == 3) {
                                                echo "selected";
                                            }
                                            ?>>Vendedor</option>

                        <option value="4" <?php
                                            if ($rol == 4) {
                                                echo "selected";
                                            }
                                            ?>>Cliente</option>
                    </select>
                </div>
                <a href="usuarios.php"><button type="button" class="btn btn-primary"><i class="fas fa-user-edit"></i>
                        Cancelar</button></a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar
                    Usuario</button>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "../Cliente/include/pie.php"; ?>