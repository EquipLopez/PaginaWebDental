<?php
	$errores='';
	extract ($_REQUEST);
	try{
		//se realiza la conexion con la base de datos 
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	//se realiza la consulta para eliminiar todos los datos del la cita seleccionada en la tabla de citas de la pestaña citas.
	$sql="DELETE FROM citas WHERE idcita = '$_REQUEST[idcita]'";
	$resultado = $conexion->query($sql);
     // se hace una comparacion de la consulta en cual si esta bien se pasa a otra pestaña.
	if($resultado == true){
		//se regresa a la pagina de citas
		header('Location: citas.php');
		$errores .='Cita eliminada correctamente';
	}
?>