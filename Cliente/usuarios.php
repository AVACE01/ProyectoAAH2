<?php
session_start();
include "../Servidor/conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['cam1']) || empty($_POST['cam2']) || empty($_POST['cam3']) || empty($_POST['cam4']) || empty($_POST['cam5'])) {
        $alert = '<div class="alert alert-primary" role="alert">
                    Todos los campos son obligatorios
                </div>';
    } else {
        $c1 = $_POST['cam1'];
        $c2 = $_POST['cam2'];
        $c3 = $_POST['cam3'];
        $c4 = $_POST['cam4'];
        $c5 = md5($_POST['cam5']); // Contraseña encriptada
        $c6 = $_POST['cam6'];
        $c7 = $_POST['cam7'];
        
        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo = '$c4'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El correo ya existe!!!
                    </div>';
        } else {
            $consulta = mysqli_query($conexion, "INSERT INTO usuarios(NomUsu, ApaUsu, AmaUsu, Correo, Contra, telefono, idtipo) 
                                                VALUES ('$c1', '$c2', '$c3', '$c4', '$c5', '$c6', $c7)");
            if ($consulta) {
                $alert = '<div class="alert alert-success" role="alert">
                       Usuario registrado con éxito!!!
                    </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al guardar la información: ' . mysqli_error($conexion) . '
                    </div>';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PROYECTO!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>Hello, world!</title>
</head>

<body>

    <head>
        <!--ENCABEZADO-->
        <?php include_once("include/encabezado.php"); ?>
        <!-- fin encabezado-->
    </head>

    <!--inicia cuerpo de la pagina-->
    <div class="container" style="text-align:center">
        <h2>ADMIN DE USUARIOS</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nuevo Usuario
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>

                    <?php if ($_SESSION['rol'] == 1) { ?>
                    <th scope="col">Correo</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                include_once("../Servidor/conexion.php");
                $con = mysqli_query($conexion, "SELECT u.idusuario,u.NomUsu, u.ApaUsu, u.AmaUsu, u.Correo, u.telefono, t.tipousu FROM usuarios u INNER JOIN tipousuarios t ON u.idtipo=t.idtipo");
                $res = mysqli_num_rows($con);
                while ($datos = mysqli_fetch_assoc($con)) {
                ?>
                <tr>
                    <td><?php echo $datos['NomUsu'] ?></td>
                    <td><?php echo $datos['ApaUsu'] ?></td>
                    <td><?php echo $datos['AmaUsu'] ?></td>

                    <?php if ($_SESSION['rol'] == 1) { ?>
                    <td><?php echo $datos['Correo'] ?></td>
                    <td><?php echo $datos['telefono'] ?></td>
                    <td><?php echo $datos['tipousu'] ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?php echo $datos['idusuario']; ?>" class="btn btn-light"><i class="fi fi-rr-pencil"></i></a>
                        <a href="../Servidor/borrar_usuario.php?id=<?php echo $datos['idusuario']; ?>" class="btn btn-danger"><i class="fi fi-rr-trash"></i></a>
                    </td>
                    <?php } ?>

                </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de usuarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form style="margin: 5%" method="POST">
                        <div>
                            <?php echo isset($alert) ? $alert : ""; ?>
                        </div>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Nombre</span>
                            <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre"
                                aria-describedby="addon-wrapping" id="cam1" name="cam1">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Apellido Paterno</span>
                            <input type="text" class="form-control" placeholder="Apellido Paterno" aria-label="Apellido Paterno"
                                aria-describedby="addon-wrapping" id="cam2" name="cam2">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Apellido Materno</span>
                            <input type="text" class="form-control" placeholder="Apellido Materno" aria-label="Apellido Materno"
                                aria-describedby="addon-wrapping" id="cam3" name="cam3">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Correo</span>
                            <input type="email" class="form-control" placeholder="Correo" aria-label="Correo"
                                aria-describedby="addon-wrapping" id="cam4" name="cam4">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Contraseña</span>
                            <input type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña"
                                aria-describedby="addon-wrapping" id="cam5" name="cam5">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Teléfono</span>
                            <input type="text" class="form-control" placeholder="Teléfono" aria-label="Teléfono"
                                aria-describedby="addon-wrapping" id="cam6" name="cam6">
                        </div>
                        <br>
                        <select class="form-select" aria-label="Default select example" id="cam7" name="cam7">
                            <?php
                            include_once("../Servidor/conexion.php");
                            $cone = mysqli_query($conexion, "SELECT * FROM tipousuarios");
                            $resu = mysqli_num_rows($cone);
                            while ($datos = mysqli_fetch_assoc($cone)) {
                            ?>
                            <option value="<?php echo $datos['idtipo'] ?>"><?php echo $datos['tipousu'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--termina cuerpo de la pagina-->
    <footer style="position: absolute; bottom: 0; width: 100%; height: 40px;">
        <!--PIE-->
        <?php include_once("include/pie.php"); ?>
        <!-- fin pie-->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>