<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="js/pie.css" rel="stylesheet">
</head>

<body>

    <head>
        <!--ENCABEZADO-->
        <?php include_once("include/encabezado.php"); ?>
        <!-- fin encabezado-->
    </head>

    <div class="container">
        <h2>Reportes de usuarios</h2>
        <div class="row">
            <div class="col">
                <a href="R_usu_pdf.php">
                    <img src="img/PDF.png" width="150px" height="150px">
                </a>

            </div>
            <div class="col">
                <a href="R_usu_excel.php">
                    <img src="img/Excel.png" width="180px" height="120px">
                </a>
            </div>
            <div class="col">
                <a href="R_usu_grafica.php">
                    <img src="img/Graf.png" width="180px" height="120px">
                </a>
            </div>

        </div>
    </div>
    <div class="container">
        <h2>Reportes de productos</h2>
        <div class="row">
            <div class="col">
                <a href="R_pro_pdf.php">
                    <img src="img/PDF.png" width="150px" height="150px">
                </a>

            </div>
            <div class="col">
                <a href="R_pro_excel.php">
                    <img src="img/Excel.png" width="180px" height="120px">
                </a>
            </div>
            <div class="col">
                <a href="R_pro_grafica.php">
                    <img src="img/Graf.png" width="180px" height="120px">
                </a>
            </div>

        </div>
    </div>

    <<div class="container">
        <h2>Reportes de Categorias</h2>
        <div class="row">
            <div class="col">
                <a href="R_cate_pdf.php">
                    <img src="img/PDF.png" width="150px" height="150px">
                </a>

            </div>
            <div class="col">
                <a href="R_cate_excel.php">
                    <img src="img/Excel.png" width="180px" height="120px">
                </a>
            </div>
            <div class="col">
                <a href="R_cate_grafica.php">
                    <img src="img/Graf.png" width="180px" height="120px">
                </a>
            </div>

        </div>
    </div>
    <!--  <footer style="position: absolute; bottom: 0; width: 100%; height: 40px;">'

        PIE-->
        <?php include_once("include/pie.php"); ?>
        <!-- fin pie-->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>