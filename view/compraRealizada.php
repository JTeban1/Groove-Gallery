<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de compra</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/popper.min.js"></script>
    <link rel="icon" href="../Img/logoIcon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b56decc6bc.js" crossorigin="anonymous"></script>
</head>

<body style="overflow: scroll;">
    <header class="p-3 text-bg-dark">
        <div class="dropdown">
            <div class="d-flex flex-wrap ">
                <a href="../index.php" class="navbar-brand d-flex align-items-center my-2 my-lg-0 me-lg-auto">
                    <img src="../Img/logoIcon.png" style="border-radius: 20px;" height="40px"></img>
                    <strong>Groove Gallery</strong>
                </a>
                <?php if (isset($_SESSION['idrol'])) { ?>
                    <div class="text-end navbar-brand d-flex">
                        <?php if ($_SESSION['idrol'] == 1) { ?>
                            <button type="button" onclick="location.href='../logicaviews/pageadmin.php'" class="btn btn-outline-light me-2">Administrar</button>
                        <?php } ?>
                        <button type="button" onclick="location.href='../crud/logout.php'" class="btn btn-warning">Salir</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </header>
    <div class="text-dark">
        <div class='p-3 text-center '>
            <h1 class='col col-12 my-auto mt-3'>Compra Realizada</h1>

            <i class="fa-regular fa-circle-check m-3 text-success" style='font-size: 60px;'></i>

            <p class='col col-12 m-auto fw-semibold'>Tu compra se realizo correctamente</p>
        </div>
    </div>
    <div class="container text-center " style=''>
        <div class="row g-2 mt-3 align-content-center justify-content-center">
            <div class="col-md-4 col-auto text-left">
                <?php
                require '../crud/conf/connection.php';
                $result = $conexion->prepare("SELECT *, ar.nombre as nombreArticulo FROM venta ve INNER JOIN detalle_venta dv ON dv.idventa = ve.idventa INNER JOIN articulo ar ON ar.idarticulo = dv.idarticulo INNER JOIN personafacturacion pf ON ve.idFacturacion = pf.idFacturacion WHERE ve.idventa = (SELECT idventa FROM venta WHERE idusuario = :idusuario ORDER BY idventa DESC LIMIT 1)")
                    or die("Could not execute the select query.");
                $result->execute(array(':idusuario' => $_SESSION['iduser']));
                $rowDatosFacturacion = $result->fetch(PDO::FETCH_ASSOC);
                ?>
                <li class="mb-4 p-3 list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h5 class="my-0">Nombre</h5>

                    </div>
                    <strong class="text-dark"><?php echo $rowDatosFacturacion['nombre'] . ' ' . $rowDatosFacturacion['apellido'] ?></strong>
                </li>

                <li class="mb-4 p-3 list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h5 class="my-0">Celular</h5>

                    </div>
                    <strong class="text-dark"><?php echo $rowDatosFacturacion['telPrincipal'] ?></strong>
                </li>

                <li class="mb-4 p-3 list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h5 class="my-0">Correo</h5>

                    </div>
                    <strong class="text-dark"><?php echo $rowDatosFacturacion['email'] ?></strong>
                </li>

                <li class="mb-4 p-1 list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h5 class="my-0">Direccion</h5>

                    </div>
                    <div class="text-dark ">
                        <h6 class="my-0">
                            <?php echo $rowDatosFacturacion['region'].' - '. $rowDatosFacturacion['barrio'] ?></h6>
                        <h6><?php echo $rowDatosFacturacion['postalCode'] .' - '. $rowDatosFacturacion['direccion'] ?>
                        </h6>
                    </div>
                </li>

                <li class="mb-4 p-3 list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h5 class="my-0">Total</h5>

                    </div>
                    <strong class="text-dark"><?php echo $rowDatosFacturacion['total'] ?></strong>
                </li>
            </div>
            <div class="col-md-4 col-auto text-left">
                <?php
                $result = $conexion->prepare("SELECT *, ar.nombre as nombreArticulo FROM venta ve INNER JOIN detalle_venta dv ON dv.idventa = ve.idventa INNER JOIN articulo ar ON ar.idarticulo = dv.idarticulo INNER JOIN personafacturacion pf ON ve.idFacturacion = pf.idFacturacion WHERE ve.idventa = (SELECT idventa FROM venta WHERE idusuario = :idusuario ORDER BY idventa DESC LIMIT 1)")
                    or die("Could not execute the select query.");
                $result->execute(array(':idusuario' => $_SESSION['iduser']));

                while ($rowDatosFacturacion = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <li class="mb-4 p-1 list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h5 class="my-0">Producto</h5>
                            <small class="text-dark"><?php echo $rowDatosFacturacion['cantidad']; ?></small>
                        </div>
                        <div class="text-dark">
                            <h6 class="my-0"><?php echo $rowDatosFacturacion['nombreArticulo']; ?></h6>
                            <small class="text-dark"><?php echo $rowDatosFacturacion['precio']; ?></small>
                        </div>
                    </li>
                <?php } ?>

            </div>

            <div class="col-md-8 col-auto text-left mb-5">
                <button class="w-50 btn btn-lg btn-success btn-outline-light border-success" onclick="location.href='../index.php';">Cerrar</button>
            </div>
        </div>
    </div>
    <?php include "../include/footer.php" ?>
</body>

</html>