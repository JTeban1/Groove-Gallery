<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/header.css">
    <script src="https://kit.fontawesome.com/ab85eb1799.js" crossorigin="anonymous"></script>
</head>
<body>
   
    
   <header>
   <div class="brand">
            <a href="../index.php" class="navbar-brand d-flex align-items-center">
                <strong>Groove Gallery</strong>
            </a>
        </div>

        <?php 
            if (!isset($_SESSION['valid'])) {
        ?>
            <button class="navbar-toggler " id="loginButton" onclick="location.href = 'login.view.php';"title="Inicio de sesión">
            <span class="fa-solid fa-circle-user"></span>
            <span class="button-text">Inicio de sesión</span>
            </button>
        <?php
            }
        ?>

      
      
 
       

        <div class="navbar" id="nav">
            
            <span class="fa-solid fa-cart-shopping" id="headIcon"
                max-height="60px" width="60px" id="dropdown01" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"></span>
                

            <div id="carrito" class="dropdown-menu" aria-labelledby="navbarCollapse">
                <div id='carritoHeader' class='p-3 text-align'>
                    <table id="lista-carrito" class="table">
                        <thead>
                            <tr style='max-width: 400px; border-bottom: solid 3px rgb(160, 160, 160);'>
                                <th class='p-1' style='max-width: 130px;'>Imagen</th>
                                <th class='p-1' style='max-width: 130px;'>Nombre</th>
                                <th class='p-1' style='max-width: 130px;'>Precio</th>
                                <th class='p-2' style='min-width: 30px;'></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        require "../crud/conf/connection.php";
                        $page; 
                        if(isset($_GET['page'])){ $page = $_GET['page'];}
                        if(isset($_SESSION['carrito'])){
                            foreach($_SESSION['carrito'] as $x=>$value){
                                $idCarrito = $_SESSION['carrito'][$x];
                                $resultado = $conexion->prepare("SELECT * FROM articulo WHERE idarticulo = :id"); 
                                $resultado->execute(array(':id' => $idCarrito));
                                $contentCarrito = $resultado->fetch(PDO::FETCH_ASSOC); 
                                ?>
                            <tr>
                                <td class='p-1' style='max-width: 130px;'><img
                                        src="<?php echo $contentCarrito['imagen']; ?>" width=100></td>
                                <td class='p-1' style='max-width: 130px; overflow: hidden;'>
                                    <?php echo $contentCarrito['nombre']; ?></td>
                                <td class='p-1' style='max-width: 130px;'><?php echo $contentCarrito['precio_venta']; ?></td>
                                <td class='p-2' style='min-width: 30px;'>
                                    <a class="borrar-producto fas fa-times-circle" style="font-size:15px; text-decoration: none; color: red;" href="
                                        <?php if(isset($_GET['a'])){
                                            echo '?a='.$_GET['a'] . '&el='.$x;
                                        }elseif(isset($page)){
                                            echo '?el='.$x.'&page='.$page; 
                                        }else{
                                            echo '?el='.$x;
                                        } ?>
                                    "></a>
                                </td>
                            </tr> <?php
                            } 
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <a id="vaciar-carrito" class="btn btn-dark btn-block" href="
                    <?php 
                    if(isset($_GET['a'])){
                        echo '?a='.$_GET['a'] . '&vaciar=1';
                    }elseif(isset($page)){
                        echo '?vaciar=1'.'&page='.$page; 
                    }else{
                        echo '?vaciar=1';
                    } ?>
                    ">Vaciar Carrito
                </a>
                <a id="procesar-pedido" href="../view/carrito.view.php" class="btn btn-dark btn-block">Procesar
                    Compra</a>

                    
            </div> 

            <!-- Botón de Buscar-->
            <?php if(isset($_SESSION['idrol'])){?>

                
                
                <div class="text-end navbar-brand d-flex">
                <div class="nav me-lg-3 ">
                    <form class="input-group " role="search" method="POST" action="">
                        <input type="search" name="search" class="col-8 form-control" placeholder="Buscar artículo"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-light" type="submit" id="button-addon2" name="botonCrud"
                            value="Buscar">
                            Buscar
                        </button>
                    </form>
                </div>
                
                </div>

                

                
                <?php if($_SESSION['idrol'] == 1){?>
                <button type="button" onclick="location.href='../logicaviews/pageadmin.php'"
                    class="btn btn-outline-light me-2">Administrar</button>

                <?php } ?>

                <button type="button" onclick="location.href='../crud/logout.php'"
                    class="btn btn-outline-light me-2 " >Salir</button>
                
                
                    
                
                
               
            <?php } ?>  
        </div>
        
       


       
                </header>
    
</body>
</html>

