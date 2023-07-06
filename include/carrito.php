<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

	if(!isset($_SESSION['carrito'])){ 
		$_SESSION['carrito']=array(); 
	} 

	if(isset($_GET['va'])){
		$contador = true;
		foreach($_SESSION['carrito'] as $x=>$value){
			if($value == $_GET['va']){
				$contador = false;
				$errores = 'informacionArticuloAgregado();';	
			}
		}
		if($contador == true){
			$producto = $_GET['va']; 
			$_SESSION['carrito'][]=$producto; 
			if(isset($_GET['a'])){
				header("Location: ?a=".$_GET['a']."");
			}else{
				header("Location: ?page=".$_GET['page']."");
			}
		}
	}

	if(isset($_GET['el'])){
		$ad = array();
		foreach($_SESSION['carrito'] as $x=>$value){
			$ad[] = $_SESSION['carrito'][$x];
		} 
		unset($ad[$_GET['el']]);
		unset($_SESSION['carrito']);
		foreach($ad as $x=>$value){
			$_SESSION['carrito'][] = $ad[$x];
		} 
		if(isset($_GET['a'])){
			header("Location: ?a=".$_GET['a']."");
		}else{
			header("Location: ?page=".$_GET['page']."");
		}
	}


	if(isset($_GET['vaciar'])){
		unset($_SESSION['carrito']);
		if(isset($_GET['a'])){
			header("Location: ?a=".$_GET['a']."");
		}else{
			header("Location: ?page=".$_GET['page']."");
		}
	}

	function cantidadArticulos($dato){
		$articulo = $dato;
		$ad = array();
		$contador = 0;
		foreach($_SESSION['carrito'] as $x=>$value){
			if($value == $articulo){
				$contador = $contador + 1;
			}
		}
		return $contador;
	}
?>
