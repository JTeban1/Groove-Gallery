<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include("conf/connection.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$user = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$pass = $_POST['password'];
	if (empty($user) or empty($pass)){
        $errores = "Por favor rellena todos los datos correctamente";
		//Si los campos están vacíos

	} else {
		$pass = hash('sha512', $pass);
		$result = $conexion->prepare("SELECT * FROM usuario WHERE nombre = :user AND password = :password")
					or die("Could not execute the select query.");
		$result->execute(array(':user' => $user, ':password' => $pass));
		$row = $result->fetch(PDO::FETCH_ASSOC);

		if(isset($row['nombre']) && $user == $row['nombre']) {
			$_SESSION['valid'] = $row['nombre'];
			$_SESSION['iduser'] = $row['idusuario'];
			$_SESSION['idrol'] = $row['idrol'];
		} else {
			$errores = "¡Datos incorrectos, por favor verifique!";
			//Si los datos de ingreso son erróneos a los registrados
		}

		if(isset($_SESSION['valid'])) {
			header('Location: ../index.php');			
		}
	}
}
require '../view/login.view.php';
