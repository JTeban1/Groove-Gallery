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
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <script type="text/javascript" src="../JS/js.js"></script>
    <title>Descuentos</title>
    <style>
        
    </style>
</head>

<body>

    <?php              
    include "../include/carrito.php";
    include "../include/header2Cc.php";
    ?>
    <main>

        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 my-4 mx-auto text-center">
            <h1 class="display-4 mt-4 text-dark fw-semibold ">Descuentos</h1>

            <p class="lead text-dark fw-light fw-semibold">Estos son los productos con descuento incluido </p>
            
        </div>

        <div class="container" id="lista-productos">
            <div class="mb-3 text-center row row-cols-lg-4">
                <?php               
                    require "../crud/conf/connection.php";
                    $resultado;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
                        $nombre = $_POST['search'];
                        $nombre = $nombre.'%';
                        $resultado = $conexion->prepare("SELECT * FROM articulo WHERE nombre LIKE :nombre ORDER BY idarticulo DESC");
                        $resultado->execute(array(':nombre' => $nombre));   
                    }else{
                        $resultado = $conexion->prepare("SELECT * FROM articulo ORDER BY idarticulo DESC");  
                        $resultado->execute();   
                    }

                    $paginacionCard=0;
                    $articulosMaximos;
                    $articulosMinimos;
                    if(isset($_GET['page']) and $_GET['page'] != ''){
                        $articulosMaximos = 12 * $_GET['page'];
                        $articulosMinimos = $articulosMaximos - 12;
                    }
                    while($content = $resultado->fetch(PDO::FETCH_ASSOC)):
        
                        if(isset($articulosMaximos) and $articulosMinimos <= $paginacionCard and $paginacionCard < $articulosMaximos){
                            if($content['estado'] == 1){
                                include "../include/card.php"; 
                            }
                        }elseif(!isset($articulosMaximos) and $paginacionCard < 12){
                            if($content['estado'] == 1){
                                include "../include/card.php"; 
                            }
                        }
                        $paginacionCard=$paginacionCard+1;
                    endwhile;   
                    $resultUsuario = $conexion->prepare("SELECT conexionReceptor FROM usuario WHERE idusuario = :idusuario")
                    or die("Could not execute the select query.");
                    $resultUsuario->execute(array(':idusuario' => $_SESSION['iduser']));
                    $row = $resultUsuario->fetch(PDO::FETCH_ASSOC);
                    $collapse;
                    $collapseBtn = 'false';
                    if(!empty($row['conexionReceptor'])){
                        $collapse = 'show';
                        $collapseBtn = 'true';
                    }
                ?>
                

            </div>

            <?php
            include "../include/mensajeInfo.php";?>

    </main>

    

    </button>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php  
        $resultado = $conexion->prepare("SELECT * FROM articulo ORDER BY idarticulo DESC");
        $resultado->execute();   
        $paginacion=0;
        $contador=0;
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
            $paginacion=$paginacion+1;
            if($paginacion == 12){
                $contador = $contador + 1;
                ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $contador;?>"><?php echo $contador;?></a>
            </li>
            <?php
                $paginacion = 0;
                }
            }
            ?>
        </ul>
    </nav>
    <?php include "../include/footer.php" ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>

</body>

</html>