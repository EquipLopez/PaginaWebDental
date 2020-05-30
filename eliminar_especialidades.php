<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		//se realiza la conexion con la base de datos
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	//se realiza la consulta para eliminiar todos los datos del la especialidad seleccionada en la tabla de especialidad.
	$sql="DELETE FROM especialidades WHERE idespecialidad = '$_REQUEST[idespecialidad]'";
	$resultado = $conexion->query($sql);
    // se hace una comparacion de la consulta en cual si esta bien se pasa a otra pestaña.
	if($resultado == true){
		//se regresa a la pagina de especialidades
		header('Location: especialidades.php');
		$mensaje .='Especialidades eliminado correctamente';
	}
?>