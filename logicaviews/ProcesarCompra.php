<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['valid'])) {
    header('Location: /index.php');
}
require '../crud/conf/connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['firstName'];
    $apellido = $_POST['lastName'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telPrincipal = $_POST['telPrincipal'];
    $telOpcional = $_POST['telOpcional'];
    $region = $_POST['region'];
    $barrio = $_POST['barrio'];
    $postalCode = $_POST['postalCode'];
    $nombreTarjeta = $_POST['nombreTarjeta'];
    $numeroTarjeta = $_POST['numeroTarjeta'];
    $cvc = $_POST['cvc'];
    $fechaVencimiento = $_POST['fechaVencimiento'];
    //Al hacer click en botón (Realizar Pago) se declaran las varibales de los campos llenados para comprobarlos en diversas posibilidades

    if (empty($nombre) or empty($apellido) or empty($email) or empty($direccion) or empty($telPrincipal) or empty($barrio) or empty($nombreTarjeta) or empty($numeroTarjeta) or empty($cvc) or empty($fechaVencimiento)){
        $errores = "Por favor rellena la informacion correctamente";
        //Si alguno de los campos está vacío

    }else{
        date_default_timezone_set('America/Bogota');
        $DateAndTime = date("Y-m-d h:i:s",time());
        
        $iduser = $_SESSION['iduser'];
        $resultado = $conexion->prepare("SELECT pe.idpersona, pe.nombre, pe.apellido, pe.email, pe.telefono, pe.direccion FROM usuario us INNER JOIN persona pe ON us.idusuario = pe.idpersona WHERE us.idusuario = :idUsuario");  
        $resultado->execute(array(':idUsuario' => $iduser));   
        $content = $resultado->fetch(PDO::FETCH_ASSOC);
        $idpersona = $content['idpersona'];
        $num_comprobante = rand(1000000,9999999);
        $subTotal = 0;

        $resultado = $conexion->prepare("SELECT ar.idarticulo, ar.nombre, ca.nombre AS categoria, ar.idcategoria, ar.codigo, ar.precio_venta, ar.stock, ar.descripcion, ar.imagen, ar.estado  FROM articulo ar INNER JOIN categoria ca ON ca.idcategoria = ar.idcategoria WHERE idarticulo = (SELECT MAX(idarticulo) FROM articulo)");
        $resultado->execute();   
        $content = $resultado->fetch(PDO::FETCH_ASSOC);

        if(isset($_SESSION['carritoProcesado'])){
            foreach($_SESSION['carrito'] as $x=>$value){
                $idCarrito = $_SESSION['carrito'][$x]; 
                $resultado = $conexion->prepare("SELECT * FROM articulo WHERE idarticulo = :id"); 
                $resultado->execute(array(':id' => $idCarrito));
                $content = $resultado->fetch(PDO::FETCH_ASSOC); 
                $subTotal = $subTotal + $content['precio_venta'] * $_SESSION['carritoProcesado'][$value];
            }
            $subTotal = $subTotal + 12000;
        }

        $statement = $conexion->prepare("INSERT INTO personafacturacion(idFacturacion, nombre, apellido, email, direccion, telPrincipal	, telOpcional, region, barrio, postalCode) VALUES (null, :nombre, :apellido, :email, :direccion, :telPrincipal, :telOpcional, :region, :barrio, :postalCode)")
        or die("Could not execute the select query.");
        $statement->execute(array(':nombre' => $nombre, ':apellido' => $apellido, ':email' => $email, ':direccion' => $direccion, ':telPrincipal' => $telPrincipal, ':telOpcional' => $telOpcional, ':region' => $region, ':barrio' => $barrio, ':postalCode' => $postalCode));

        $resultado = $conexion->prepare("SELECT idFacturacion FROM personafacturacion ORDER BY idFacturacion DESC LIMIT 1");
        $resultado->execute();   
        $contentFacturacion = $resultado->fetch(PDO::FETCH_ASSOC);

        $resultado = $conexion->prepare('INSERT INTO mediopago (idMedioPago, nombre, tarjeta, cvc, fecha) VALUES (null, :nombre, :tarjeta, :cvc, :fecha)');
        $resultado->execute(array(':nombre' => $nombreTarjeta, ':tarjeta' => $numeroTarjeta, ':cvc' => $cvc, ':fecha' => $fechaVencimiento));  

        $resultado = $conexion->prepare("SELECT idMedioPago FROM mediopago ORDER BY idMedioPago DESC LIMIT 1");
        $resultado->execute();   
        $contentMediopago = $resultado->fetch(PDO::FETCH_ASSOC);

        $resultado = $conexion->prepare('INSERT INTO venta (idventa, idpersona, idusuario, idFacturacion, idMedioPago, tipo_comprobante, num_comprobante, fecha_hora, total) VALUES (null, :idpersona, :idusuario, :idFacturacion, :idMedioPago, :tipo_comprobante, :num_comprobante, :fecha_hora, :total)');
        $resultado->execute(array(':idpersona' => $idpersona, ':idusuario' => $_SESSION['iduser'], ':idFacturacion' => $contentFacturacion['idFacturacion'], ':idMedioPago' => $contentMediopago['idMedioPago'], ':tipo_comprobante' => 'Virtual', ':num_comprobante' => $num_comprobante, ':fecha_hora' => $DateAndTime, ':total' => $subTotal));  

        $resultado = $conexion->prepare("SELECT idventa FROM venta ORDER BY idventa DESC LIMIT 1");
        $resultado->execute();   
        $contentVenta = $resultado->fetch(PDO::FETCH_ASSOC);

        if(isset($_SESSION['carritoProcesado'])){
            foreach($_SESSION['carrito'] as $x=>$value){
                $idCarrito = $_SESSION['carrito'][$x];
                $resultado = $conexion->prepare("SELECT * FROM articulo WHERE idarticulo = :id"); 
                $resultado->execute(array(':id' => $idCarrito));
                $contentCarrito = $resultado->fetch(PDO::FETCH_ASSOC); 
                $precio = $contentCarrito['precio_venta'] * $_SESSION['carritoProcesado'][$value];
                $resultado = $conexion->prepare('INSERT INTO detalle_venta (iddetalle_venta, idventa, idarticulo, cantidad, precio) VALUES (null, :idventa, :idarticulo, :cantidad, :precio)');
                $resultado->execute(array(':idventa' => $contentVenta['idventa'], ':idarticulo' => $idCarrito, ':cantidad' => $_SESSION['carritoProcesado'][$value], ':precio' => $precio));
            }
        }

        unset($_SESSION['carritoProcesado']);
        unset($_SESSION['carrito']);
        header('Location: ../view/compraRealizada.php');
    }
}

$iduser = $_SESSION['iduser'];
$resultado = $conexion->prepare("SELECT pe.nombre, pe.apellido, pe.email, pe.telefono, pe.direccion FROM usuario us INNER JOIN persona pe ON us.idusuario = pe.idpersona WHERE us.idusuario = :idUsuario");  
$resultado->execute(array(':idUsuario' => $iduser));   
$content = $resultado->fetch(PDO::FETCH_ASSOC);

require '../view/ProcesarCompra.view.php';

?>