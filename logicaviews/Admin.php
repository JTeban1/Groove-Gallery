<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['valid'])) {
        header('Location: crud/login.php');
    }
    //Se retorna a vista login en caso de no tener una sesión activa

    require '../crud/conf/connection.php';

    $idArticuloCargado = null;

    function desactivarInsertar(){
        $display = 'block'; 
        global $idArticuloCargado;
        if(isset($idArticuloCargado)){
            $display = 'none';
        } 
        return $display; 
    }

    if(isset($_GET['a'])){
        $idArticuloCargado = $_GET['a'];
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo'])) {

    $idarticulo = $_POST['idarticulo'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $botonCrud = $_POST['botonCrud'];
    //Al hacer click en el botón para insertar nuevo artículo se declaran las variables de los campos usados

    if (empty($nombre) or empty($codigo) or empty($descripcion) or empty($imagen) or empty($precio) or empty($precio)){
        $errores = "Por favor rellena todos los datos correctamente";
        //Si alguno de los campos está vacío
    }else{
        switch ($botonCrud) {
            case "Insertar":
                $resultado = $conexion->prepare('INSERT INTO articulo (idarticulo, idcategoria, codigo, nombre, precio_venta, stock, descripcion, imagen, estado) VALUES (null, :categoria, :codigo, :nombre, :precio_venta, :stock, :descripcion, :imagen, :estado)');
                $resultado->execute(array(':categoria' => $categoria, ':codigo' => $codigo, ':nombre' => $nombre, ':precio_venta' => $precio, ':stock' => $stock, ':descripcion' => $descripcion, ':imagen' => $imagen, ':estado' => $estado));
                //Query para insertar artículos


                $resultado = $conexion->prepare("SELECT ar.idarticulo, ar.nombre, ca.nombre AS categoria, ar.idcategoria, ar.codigo, ar.precio_venta, ar.stock, ar.descripcion, ar.imagen, ar.estado  FROM articulo ar INNER JOIN categoria ca ON ca.idcategoria = ar.idcategoria WHERE idarticulo = (SELECT MAX(idarticulo) FROM articulo)");
                $resultado->execute();   
                $content = $resultado->fetch(PDO::FETCH_ASSOC);
                break;
                //Query el cual retorna el artículo insertado

            case "Actualizar":
                $resultado = $conexion->prepare("UPDATE articulo SET idcategoria=:categoria, codigo=:codigo, nombre=:nombre, precio_venta=:precio, stock=:stock,descripcion=:descripcion, imagen=:imagen, estado=:estado WHERE idarticulo=:idarticulo");
                $resultado->execute(array(':idarticulo' => $idarticulo, ':categoria' => $categoria, ':codigo' => $codigo, ':nombre' => $nombre, ':precio' => $precio, ':stock' => $stock, ':descripcion' => $descripcion, ':imagen' => $imagen, ':estado' => $estado));  
                //Query para actualizar artículos

                $resultado = $conexion->prepare("SELECT ar.idarticulo, ar.nombre, ca.nombre AS categoria, ar.idcategoria, ar.codigo, ar.precio_venta, ar.stock, ar.descripcion, ar.imagen, ar.estado FROM articulo ar INNER JOIN categoria ca ON ca.idcategoria = ar.idcategoria WHERE idarticulo = :id");
                $resultado->execute(array(':id' => $idarticulo));   
                $content = $resultado->fetch(PDO::FETCH_ASSOC);
                $idArticuloCargado = $idarticulo;
                break;
                //Query el cual retorna el artículo actualizado

            case "Eliminar":
                $resultado = $conexion->prepare('DELETE FROM articulo WHERE idarticulo = :id');  
                $resultado->execute(array(':id' => $idarticulo));   
                break;
                //Query para eliminar artículos
        }
    }

}elseif($_SERVER['REQUEST_METHOD'] == 'get' && isset($_POST['botonCrud'])){
    $botonCrud = $_POST['botonCrud'];

}else{
    if(isset($idArticuloCargado)){
        $idarticulo = $idArticuloCargado;
        $resultado = $conexion->prepare("SELECT ar.idarticulo, ar.nombre, ca.nombre AS categoria, ar.idcategoria, ar.codigo, ar.precio_venta, ar.stock, ar.descripcion, ar.imagen, ar.estado FROM articulo ar INNER JOIN categoria ca ON ca.idcategoria = ar.idcategoria WHERE idarticulo = :id");  
        $resultado->execute(array(':id' => $idarticulo));   
        $content = $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
    require '../view/Admin.view.php';
?>