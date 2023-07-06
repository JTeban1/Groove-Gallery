<?php 
    require '../crud/conf/connection.php';
    /*
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['valid'])) {
        header('Location: ../crud/login.php');
    } */

    $idArticuloCargado = null;

    if(isset($_GET['a'])){
        $idArticuloCargado = $_GET['a'];
    }

    if(isset($idArticuloCargado)){
        $idarticulo = $idArticuloCargado;
        $resultado = $conexion->prepare("SELECT ar.idarticulo, ar.nombre, ca.nombre AS categoria, ar.idcategoria, ar.codigo, ar.precio_venta, ar.stock, ar.descripcion, ar.imagen, ar.estado FROM articulo ar INNER JOIN categoria ca ON ca.idcategoria = ar.idcategoria WHERE idarticulo = :id");  
        $resultado->execute(array(':id' => $idarticulo));   
        $content = $resultado->fetch(PDO::FETCH_ASSOC);
    }
    //Se hace una consulta para traer los artículos
    require "../view/Detalles.view.php";
?>
