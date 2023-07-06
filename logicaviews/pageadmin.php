<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['valid'])) {
    header('Location: ../crud/login.php');
}
require '../crud/conf/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $nombre = $_POST['search'];
    $nombre = $nombre.'%';
    $resultado = $conexion->prepare("SELECT ar.idarticulo, ar.nombre, ca.nombre AS categoria, ar.codigo, ar.precio_venta, ar.stock, ar.descripcion, ar.imagen, ar.estado FROM articulo ar INNER JOIN categoria ca ON ca.idcategoria = ar.idcategoria WHERE ar.nombre LIKE :nombre");
    $resultado->execute(array(':nombre' => $nombre));   
    $conexion = null;
}else{
    require "../crud/conf/connection.php";
    $resultado = $conexion->prepare("SELECT ar.idarticulo, ar.nombre, ca.nombre AS categoria, ar.codigo, ar.precio_venta, ar.stock, ar.descripcion, ar.imagen, ar.estado FROM articulo ar INNER JOIN categoria ca ON ca.idcategoria = ar.idcategoria ORDER BY idarticulo DESC");  
    $resultado->execute();   
    $conexion = null;
}

include '../view/pageadmin.view.php';
?>