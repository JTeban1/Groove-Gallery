<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['valid'])) {
        header('Location: ../crud/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="icon" href="../Img/logoIcon.png">
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
    <title>Carrito Compras</title>

</head>

<body>
    <header class="p-3 text-bg-dark">
        <div class="dropdown">
            <div class="d-flex flex-wrap ">
                <a href="../index.php" class="navbar-brand d-flex align-items-center my-2 my-lg-0 me-lg-auto">
                    <strong>Groove Gallery</strong>
                </a>
                <?php if(isset($_SESSION['idrol'])){?>
                <div class="text-end navbar-brand d-flex">
                    <?php if($_SESSION['idrol'] == 1){?>
                    <button type="button" onclick="location.href='../logicaviews/pageadmin.php'"
                        class="btn btn-outline-light me-2">Administrar</button>
                    <?php } ?>
                    <button type="button" onclick="location.href='../crud/logout.php'"
                        class="btn btn-warning">Salir</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </header>
    <?php 
    require "../crud/conf/connection.php";
    require "../include/carrito.php";
    ?>
    <br>

    <form action="../logicaviews/ProcesarCompra.php" method="GET">
    <main>
            <div class="container">
                <div class="row mt-0">
                    <div class="col">
                        <h2 class="d-flex justify-content-center mb-3">Visualiza tu carrito</h2>

                            <div id="carrito" class="form-group col-sm-12 table-responsive">
                                <table class="table" id="lista-compra">
                                    <thead style="border-bottom: solid 4px black; font-size: 18px;">
                                        <tr>
                                            <th style='min-width: 90px;' class="text-center" scope="col">Imagen</th>
                                            <th style='min-width: 90px;' class="text-center" scope="col">Nombre</th>
                                            <th style='min-width: 90px;' class="text-center" scope="col">Precio</th>
                                            <th style='min-width: 90px;' class="text-center" scope="col">Cantidad</th>
                                            <th style='max-width: 90px;' class="text-center" scope="col">Eliminar</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                $subTotal = 0;
                                if(isset($_SESSION['carrito'])){
                                    foreach($_SESSION['carrito'] as $x=>$value){
                                        $idCarrito = $_SESSION['carrito'][$x];
                                        $resultado = $conexion->prepare("SELECT * FROM articulo WHERE idarticulo = :id"); 
                                        $resultado->execute(array(':id' => $idCarrito));
                                        $contentCarrito = $resultado->fetch(PDO::FETCH_ASSOC); 
                                        $subTotal = $subTotal + $contentCarrito['precio_venta'];
                                        if($value == $contentCarrito['idarticulo'] && cantidadArticulos($contentCarrito['idarticulo']) >= 1){
                                    ?>
                                        <tr>
                                            <td class='p-1 text-center' style='min-width: 90px;'>
                                                <img src="<?php echo $contentCarrito['imagen']; ?>" width=100>
                                            </td>
                                            <td class='p-1 text-center' style='min-width: 90px; overflow: hidden;'>
                                                <?php echo $contentCarrito['nombre']; ?>
                                            </td>
                                            <td class='p-1 text-center' style='min-width: 90px;'>
                                                $<?php echo $contentCarrito['precio_venta']; ?>
                                            </td>
                                            <td class='p-1 text-center' style='min-width: 90px;'>
                                                <input style='max-width: 50px;' class='border-0 bg-light m-auto'
                                                    type="number" value="1" name="<?php echo $x; ?>"
                                                    min="1" max="20">
                                            </td>
                                            <td class='p-1 text-center' style='max-width: 90px;'>
                                                <a class="borrar-producto fas fa-times-circle"
                                                    style="font-size:20px; text-decoration: none; color: red;" href="
                                                    <?php if(isset($_GET['a'])){
                                                        echo '?a='.$_GET['a'] . '&el='.$x;
                                                    }else{
                                                        echo '?el='.$x; 
                                                    } ?>
                                                "></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        } 
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row justify-content-center" id="loaders">
                                <img id="cargando" src="../img copy/cargando.gif" width="220">
                            </div>
                        
                            <div class="row justify-content-between">
                                <div class="col-md-4 mb-2">
                                    <a href="../index.php" class="btn btn-dark btn-block">Seguir comprando</a>
                                </div>
                                <div class="col-xs-12 col-md-4">                 
                                    <input type="submit" class="btn btn-success btn-block"
                                        id="procesar-compra" value="Procesar carrito">    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <?php     
            if(empty($_SESSION['carrito'])){ 
                $errores = 'carritoVacio();';
                include "../include/mensajeInfo.php"; 
            }
    ?>
        </main>
        </form>
        <?php include "../include/footer.php" ?>
</body>

</html>