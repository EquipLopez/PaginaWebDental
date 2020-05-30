<?php session_start();
//se inicia la sesion con el usuario.
if(isset($_SESSION['usuario'])){
	//una vez iniicada la sesion, requiere la pestaña principal de la pagina para que el usuario la pueda ver.
	require 'vista/contenido_vista.php';
}else{
	//en caso de que no se inicie la sesion, se muestra la pantalla de inicio de sesion.
	header('Location: login.php');
}
?>