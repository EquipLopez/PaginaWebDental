<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		//se realiza la conexion con la base de datos 
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	//se realiza la consulta para eliminiar todos los datos del usuario seleccionado en la tabla de usuarios de la pestaña usuarios.
	$sql="DELETE FROM usuarios WHERE id = '$_REQUEST[id]'";
	$resultado = $conexion->query($sql);
       // se hace una comparacion de la consulta en cual si esta bien se pasa a otra pestaña.
	if($resultado == true){
		//se regresa a la pagina de citas
		header('Location: usuarios.php');
		$mensaje .='Usuario eliminado correctamente';
	}
?>