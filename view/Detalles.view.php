<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Detalles</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="icon" href="../Img/logoIcon.png">
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="../js/popper.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b56decc6bc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/home.css">

    <script type="text/javascript" src="../JS/js.js"></script>
</head>

<body>
    <?php 
    include "../include/carrito.php";
    include "../include/header2Cc.php"
    ?>
    <main class="container">
        <div class="row mb-2" style=" padding-top: 70px;">
            <div class="col-md-6" style="min-width: 100%; ">
                <div style="min-width: 100%;" id="lista-productos"
                    class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static card-header">
                        <strong class="d-inline-block mb-2 text-success">EN DESCUENTO</strong>
                        <h4 class="mb-0" id="titulo"><?php if(isset($content)){ echo $content['nombre'];} ?></h4>
                        
                        <p class="mb-auto"><b>Precio: </b></p>
                        <p class="mb-auto card-title pricing-card-title precio">
                            $<?php if(isset($content)){ echo $content['precio_venta'];} ?></p>
                        <p class="mb-auto"><b>Detalles </b></p>
                        <p class="mb-auto"><?php if(isset($content)){ echo $content['descripcion'];} ?></p>
                        <div>
                            <a href="../logicaviews/Descuentos.php" class="btn btn-dark text-white">Descuentos</a>
                            <a href="../index.php" class="btn btn-dark text-white">Volver</a>
                        </div>
                    </div>
                    <div class="col p-4 d-flex flex-column position-static ">
                        <div style="width: fit-content; margin: auto;">
                            <img class="bd-placeholder-img card-img-top"
                                style="max-height: 400px; display: block; margin: auto;"
                                src="<?php if(isset($content)){ echo $content['imagen'];} ?>"
                                style="border: solid 6px rgb(58, 19, 19);" role="img"
                                aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                        </div>
                    </div>
                    <a class="btn btn-block btn-dark text-white"
                        href="?va=<?php echo $content['idarticulo']; ?>&a=<?php echo $content['idarticulo']; ?>">Agregar
                        al carrito🛒</a>
                </div>
            </div>
        </div>
        <?php 
            include "../include/mensajeInfo.php";
        ?>
    </main>
    
    <?php include "../include/footer.php"?>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/sweetalert2.min.js"></script>
</body>

</html>