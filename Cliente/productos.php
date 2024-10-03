<?php
session_start();
include "../Servidor/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alert = "";
    
    // Validación de campos vacíos (excluyendo 'foto' de la validación inicial)
    if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) || empty($_POST['precio']) || empty($_POST['color']) || empty($_POST['tamanio']) || empty($_POST['idcat'])) {
        $alert = '<div class="alert alert-primary" role="alert">Todos los campos son obligatorios</div>';
    } else {
        $foto = '';
        // Verifica si se ha enviado una imagen
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            // Directorio donde se guardarán las imágenes
            $directorio = 'img/';
            
            // Asegurarse de que el directorio exista, si no, crearlo
            if (!is_dir($directorio)) {
                mkdir($directorio, 0755, true);
            }

            // Información del archivo subido
            $nombreArchivo = uniqid() . '_' . basename($_FILES['foto']['name']);
            $rutaArchivo = $directorio . $nombreArchivo;
            $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

            // Validar el tipo de archivo
            $tiposPermitidos = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($tipoArchivo, $tiposPermitidos)) {
                $alert = '<div class="alert alert-danger" role="alert">Error: Solo se permiten archivos de imagen (JPG, JPEG, PNG, GIF).</div>';
            } elseif ($_FILES['foto']['size'] > 2 * 1024 * 1024) { // 2MB
                $alert = '<div class="alert alert-danger" role="alert">Error: El tamaño de la imagen es demasiado grande (máximo 2MB).</div>';
            } elseif (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaArchivo)) {
                $foto = $rutaArchivo;
            } else {
                $alert = '<div class="alert alert-danger" role="alert">Error al subir la imagen.</div>';
            }
        }

        if (empty($alert)) {
            // Recogiendo y escapando datos del formulario
            $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
            $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
            $cantidad = intval($_POST['cantidad']);
            $precio = floatval($_POST['precio']);
            $color = mysqli_real_escape_string($conexion, $_POST['color']);
            $tamanio = mysqli_real_escape_string($conexion, $_POST['tamanio']);
            $idcat = intval($_POST['idcat']);

            // Query para insertar el nuevo producto
            $query = "INSERT INTO productos (nombre, descripcion, cantidad, precio, color, tamanio, foto, idcat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "ssidsssi", $nombre, $descripcion, $cantidad, $precio, $color, $tamanio, $foto, $idcat);
            
            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                $alert = '<div class="alert alert-success" role="alert">Producto guardado exitosamente.</div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">Error al guardar la información: ' . mysqli_error($conexion) . '</div>';
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Meta tags requeridos -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="js/pie.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>Administración de Productos</title>
</head>

<body>

    <head>
        <!-- ENCABEZADO -->
        <?php include_once("include/encabezado.php"); ?>
        <!-- fin encabezado -->
    </head>

    <!-- inicia cuerpo de la página -->
    <div class="container">
        <h2>PRODUCTOS</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nuevo Producto
        </button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Color</th>
                    <th scope="col">Tamaño</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta para obtener todos los productos
                $con = mysqli_query($conexion, "SELECT * FROM productos");
                while ($datos = mysqli_fetch_assoc($con)) {
                ?>
                <tr>
                    <td><?php echo $datos['nombre']; ?></td>
                    <td><?php echo $datos['descripcion']; ?></td>
                    <td><?php echo $datos['cantidad']; ?></td>
                    <td><?php echo $datos['precio']; ?></td>
                    <td><?php echo $datos['color']; ?></td>
                    <td><?php echo $datos['tamanio']; ?></td>
                    <td>
                        <?php
                        // Mostrar la imagen del producto
                        $rutaImagen = htmlspecialchars($datos['foto']);
                        echo "<img src='$rutaImagen' width='50px' height='50px' >";
                        ?>
                    </td>
                    <td>
                        <!-- Botón para editar producto -->
                        <a href="editar_productos.php?id=<?php echo $datos['idprod']; ?>">
                            <button type="button" class="btn btn-light"><i class="fi fi-rr-pencil"></i></button>
                        </a>
                    </td>
                    <td>
                        <!-- Botón para borrar producto -->
                        <a href="../Servidor/borrar_productos.php?id=<?php echo $datos['idprod']; ?>">
                            <button type="button" class="btn btn-danger"><i class="fi fi-rr-trash"></i></button>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar nuevo producto -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar nuevo producto -->
                    <form method="POST" enctype="multipart/form-data">
                        <div><?php echo isset($alert) ? $alert : ""; ?></div>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Nombre</span>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Descripción</span>
                            <input type="text" class="form-control" name="descripcion">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Cantidad</span>
                            <input type="text" class="form-control" name="cantidad">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Precio</span>
                            <input type="text" class="form-control" name="precio">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Color</span>
                            <input type="text" class="form-control" name="color">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Tamaño</span>
                            <input type="text" class="form-control" name="tamanio">
                        </div>
                        <br>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Foto</span>
                            <input type="file" class="form-control" name="foto">
                        </div>
                        <br>
                        <select class="form-select" name="idcat">
                            <?php
                            // Obtener las categorías para el select
                            $cone = mysqli_query($conexion, "SELECT * FROM categorias");
                            while ($datos = mysqli_fetch_assoc($cone)) {
                            ?>
                            <option value="<?php echo $datos['idcat']; ?>"><?php echo $datos['categoria']; ?></option>
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
    <!-- termina cuerpo de la página -->

    <footer style="position: absolute; bottom: 0; width: 100%; height: 40px;">
        <!-- PIE DE PÁGINA -->
        <?php include_once("include/pie.php"); ?>
        <!-- fin pie de página -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>