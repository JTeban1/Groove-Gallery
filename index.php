<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['valid'])) {
    header('Location: view/home.php');
}else{
    header('Location: view/home.php');
}
//Al abrir el link lleva a vista de home, no login
?>
