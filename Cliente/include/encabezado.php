<?php
if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 120) {
    session_destroy();
    /* Aquí redireccionas a la url especifica */
    header("Location:../index.php");
    die();
}

$_SESSION['tiempo'] = time(); // Si hay actividad seteamos el valor al tiempo actual
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="text-align: center; background-color: rgb(227, 164, 70);">
        <div class="row">
            <div class="col-3">
                <img src="img/Logo_Mecanico.png" height="200px" width="200px" style="padding-top: 30px;">
            </div>
            <div class="col" style="padding-top: 80px;">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="inicio.php"> <button type="button" class="btn btn-Success">Inicio</button></a>
                    <a href="usuarios.php"> <button type="button" class="btn btn-Success">Usuarios</button></a>
                    <a href="categorias.php"> <button type="button" class="btn btn-Success">Categorias</button></a>
                    <a href="promociones.php"> <button type="button" class="btn btn-Success">Promociones</button></a>
                    <a href="reportes.php"> <button type="button" class="btn btn-Success">Reportes</button></a>
                    <a href="productos.php"> <button type="button" class="btn btn-Success">Produtos</button></a>
                    <a href="salir.php"><button type="button" class="btn btn-Success">Salir</button></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>