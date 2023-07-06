<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Administrador</title>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="icon" href="../Img/logoIcon.png">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <script>
        //EVITAR EL REENVIO DE FORMULARIOS----------------------------------------------------------------------
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href, '../logicaviews/Admin.php');
        }
    </script>
    <header class="p-3 text-bg-dark">
        <div class="dropdown">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="../index.php" class="d-flex align-items-center mb-2 mb-lg-0 me-lg-auto text-white text-decoration-none">
                    <strong>Groove Gallery</strong>
                </a>

                <div class="nav col-12 me-lg-3 col-md-5">
                    <form class="input-group " role="search" method="POST" action="../logicaviews/pageadmin.php">
                        <input type="search" name="search" class="col-8 form-control" placeholder="Buscar artículo"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-light" type="submit" id="button-addon2" name="botonCrud"
                            value="Buscar">
                            Buscar
                        </button>
                    </form>
                </div>
            
                <div class="text-end">
                    <button type="button" onclick="location.href='../crud/logout.php'" class="btn btn-warning">Salir</button>
                </div>
            </div>
        </div>
    </header>

    <div class="row m-lg-0" style="width: 100%;">
        <div class="col-sm-6 w-75 p-lg-0 overflow-auto" style="max-height: 50vw; min-height: 50vw;">
            <table class="table">
                <thead class="table-light text-center">
                    <tr>
                        <th style="max-width: 100px; min-width: 100px;">IdArticulo</th>
                        <th style="max-width: 100px; min-width: 100px;">Categoria</th>
                        <th style="max-width: 100px; min-width: 100px;">Codigo</th>
                        <th style="max-width: 100px; min-width: 100px;">Nombre</th>
                        <th style="max-width: 100px; min-width: 100px;">Precio</th>
                        <th style="max-width: 100px; min-width: 100px;">Stock</th>
                        <th style="max-width: 100px; min-width: 100px;">Descripcion</th>
                        <th style="max-width: 100px; min-width: 100px;">Imagen</th>
                        <th style="max-width: 100px; min-width: 100px;">Estado (Descuento)</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php
                    while($content = $resultado->fetch(PDO::FETCH_ASSOC)):   
                ?>
                    <tr class="me-lg-auto" onclick="location.href='../logicaviews/Admin.php?a=<?php echo $content['idarticulo']; ?>'">
                        <td class="text-center"style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $content['idarticulo']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $content['categoria']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $content['codigo']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $content['nombre']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $content['precio_venta']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $content['stock']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $content['descripcion']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" ><?php echo $content['imagen']; ?></td>
                        <td style="max-width: 180px; min-height: 50px; max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php if('1' == $content['estado']){echo "Habilitado";}else{echo "Deshabilitado";} ?></td>
                    </tr>
                <?php endwhile;  ?>
                </tbody>
            </table>
        </div>
        <div class="container w-25 bg-light align-middlef">
            <div class="container text-center mt-5">
                <div class="mt-5">
                    <h3 class="p-3 col-12 alert align-items-center">Ingresar nuevo artículo</h3>
                    <div class="col align-middle">
                        <form action="../logicaviews/Admin.php" method="post">
                            <input class="p-3 col-8 border btn btn-dark btn-outline-light fs-5" type="submit" name="botonCrud"
                                value="Insertar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../include/footer.php" ?>
</body>

</html>