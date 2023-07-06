<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar instrumentos</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="icon" href="../Img/logoIcon.png">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="../js/Admin.js"></script>
    <script src="https://kit.fontawesome.com/b56decc6bc.js" crossorigin="anonymous"></script>
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
            <div class="d-flex flex-wrap ">
                <a href="../index.php" class="navbar-brand d-flex align-items-center my-2 my-lg-0 me-lg-auto">
                    <strong>Groove Gallery</strong>
                </a>
                <div class="nav col-12 col-lg-auto ">
                    <div class=" nav-linkcol-4 col-lg-auto ">
                        <button type="button" class="btn btn-outline-light me-2"
                            onclick="location.href='../logicaviews/pageadmin.php'">Lista</button>
                        <button type="button" onclick="location.href='../crud/logout.php'" class="btn btn-warning">Salir</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <form action="../logicaviews/Admin.php" method="post">

        <div style='position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.586); display: none;' id="AdvertenciaEliminar">
            <div id='validacionCrud' class='p-3 text-center'>
                <h1 class='col col-12 m-auto'>Advertencia</h1>
                <br>
                <p class='col col-12 m-auto'>¿Realmente quiere
                    <Strong id="ValueTextoBoton">"Valor definido por funcion del boton"</Strong> el artículo
                    <Strong><?php echo $content['nombre']; ?></Strong>?</p>
                <br>
                <div class='col col-12'>
                    <input class='p-3 col-5 border btn btn-dark fs-5' id='botonCrud' type='submit' name='botonCrud'
                        value=''>
                    <div class='p-3 col-5 border btn btn-warning fs-5' id='btnCerrarVerificacion'>Cancelar</div>
                </div>
            </div>
        </div>

        <div class="row text-center m-lg-0" style="width: 100%; max-height: 50vw; min-height: 50vw;">
            <div class="col-6 col-md-3 ">
                <img class="p-2" src="<?php if(isset($content)){ echo $content['imagen'];} ?>" alt="Imagen"
                    style="max-width: 100%; display: block; margin: auto;">
            </div>
            <div class="col-sm-6 col-md-7">
                <div class="container overflow-hidden text-center m-0 row justify-content-center">
                    <div class="row row-cols-lg-3">
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50" for="idarticulo">Id
                            artículo</label>
                            <input class="p-3 col-12 border bg-light" name="idarticulo" type="text"
                                value="<?php if(isset($content)){ echo $content['idarticulo'];}?>"
                                placeholder="Campo Automatico" readonly>
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50" for="nombre">Nombre del
                                producto</label>
                            <input class="p-3 col-12 border bg-light" name="nombre" type="text"
                                value="<?php if(isset($content)){ echo $content['nombre'];} ?>" placeholder="Nombre">
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50" for="codigo">Codigo del
                            artículo</label>
                            <input class="p-3 col-12 border bg-light" name="codigo"
                                value="<?php if(isset($content)){ echo $content['codigo'];} ?>" type="text"
                                placeholder="Codigo">
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50"
                                for="categoria">Categoria</label>
                            <select class="p-3 col-12 border bg-light" placeholder="categoria" name="categoria">
                                <?php 
                                    $resultado = $conexion->prepare("SELECT * FROM categoria ORDER BY idcategoria ASC"); 
                                    $resultado->execute();
        
                                    while($categoria = $resultado->fetch(PDO::FETCH_ASSOC)):  
                                        if($categoria['idcategoria'] == $content['idcategoria']){
                                            ?>
                                <option value="<?php echo $categoria['idcategoria']; ?>" selected>
                                    <?php echo $categoria['nombre']; ?></option>
                                <?php 
                                        }else{
                                            ?>
                                <option value="<?php echo $categoria['idcategoria']; ?>">
                                    <?php echo $categoria['nombre']; ?></option>
                                <?php 
                                        }
                                    endwhile;  
                                ?>
                            </select>
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50"
                                for="precio">Precio</label>
                            <input class="p-3 col-12 border bg-light" name="precio"
                                value="<?php if(isset($content)){ echo $content['precio_venta'];} ?>" type="number"
                                placeholder="Precio">
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50"
                                for="stock">Stock</label>
                            <input class="p-3 col-12 border bg-light" name="stock"
                                value="<?php if(isset($content)){ echo $content['stock'];} ?>" type="number"
                                placeholder="Stock">
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50" for="imagen">URL
                                Imagen</label>
                            <input class="p-3 col-12 border bg-light" name="imagen"
                                value="<?php if(isset($content)){ echo $content['imagen'];} ?>" type="url"
                                placeholder="Imagen">
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50"
                                for="descripcion">Descripcion</label>
                            <textarea class="p-3 col-12 border bg-light" style="height: 59px;" name="descripcion"
                                cols="30" rows="10"
                                placeholder="Descripcion"><?php if(isset($content)){ echo $content['descripcion'];} ?></textarea>
                        </div>
                        <div class="col gy-5">
                            <label class="col-12 border-light text-white bg-black bg-opacity-50"
                                for="estado">Descuento</label>
                            <select class="p-3 col-12 border bg-light" name="estado">
                                <?php  
                                    if($content['estado'] == "1"){
                                        ?>
                                <option value="1">Habilitado</option>
                                <option value="0">Deshabilitado</option>
                                <?php 
                                    }else{
                                        ?>
                                <option value="0">Deshabilitado</option>
                                <option value="1">Habilitado</option>
                                <?php 
                                    }
                                
                                ?>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="m-0 row justify-content-center">
                    <?php include '../include/ToolTipError.php'; ?>
                </div>
            </div>
            <div class="col-6 col-md-2 bg-white">
                <div class="container text-center ">
                    <div class="row align-items-start" id="divBtnInsertar"
                        style="display:<?php echo desactivarInsertar(); ?>">
                        <div class="col gy-5">
                            <input class="p-3 col-12 border btn btn-dark fs-5" type="submit" name="botonCrud"
                                value="Insertar">
                        </div>
                    </div>

                    <div class="row align-items-center ">
                        <div class="col gy-5">
                            <div class="p-3 col-12 border btn btn-dark fs-5" id="btnActualizar" data-value="Actualizar">Actualizar</div>
                        </div>
                    </div>

                    <div class="row align-items-end">
                        <div class="col gy-5">
                            <div class="p-3 col-12 border btn btn-dark fs-5" id="btnEliminar" data-value="Eliminar" onclick="location.href = 'Admin.view.php';">Eliminar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        let eliminar = document.getElementById("btnEliminar");
        eliminar.onclick = miFuncEliminar;
        let actualizar = document.getElementById("btnActualizar");
        actualizar.onclick = miFuncActualizar;
        let cerrar = document.getElementById("btnCerrarVerificacion");
        cerrar.onclick = miFuncCerrar;

        function miFuncActualizar() {
            const div = document.querySelector("#AdvertenciaEliminar");
            div.style.display = "block";
            document.getElementById("ValueTextoBoton").innerHTML = "actualizar";
            document.getElementById("botonCrud").value = "Actualizar";
        }

        function miFuncEliminar() {
            const div = document.querySelector("#AdvertenciaEliminar");
            div.style.display = "block";
            document.getElementById("ValueTextoBoton").innerHTML = "eliminar";
            document.getElementById("botonCrud").value = "Eliminar";
        }

        function miFuncCerrar() {
            const div = document.querySelector("#AdvertenciaEliminar");
            div.style.display = "none";
        }

    </script>
        <?php include "../include/footer.php" ?>
</body>

</html>