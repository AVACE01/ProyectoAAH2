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

    <!--inicia cuerpo de la pagina-->
    <div class="container" style="text-align: center;">
        <h2>INICIO</h2>
    </div>
    <!--termina cuerpo de la pagina-->
    <!-- INICIA  CAROUSEL-->
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    
                    <img src="img/M1.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
                <div class="carousel-item">
                    <img src="img/M2.jpeg" class="d-block w-100" alt="fondo2" width="400px" height="400px">
                </div>
                <div class=" carousel-item">
                    <img src="img/M3.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
                <div class=" carousel-item">
                    <img src="img/M4.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
                <div class=" carousel-item">
                    <img src="img/M5.jpg" class="d-block w-100" alt="fondo" width="400px" height="400px">
                </div>
            </div>
            <button class=" carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- FIN  CAROUSEL-->

    <!--<footer style = "position: absolute; bottom: 0; width: 100%; height: 40px;">-->

        <!--PIE-->
        <?php include_once("include/pie.php"); ?>
        <!-- fin pie-->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>