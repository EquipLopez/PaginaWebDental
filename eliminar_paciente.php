<?php
	$errores='';
	extract ($_REQUEST);
	try{
		//se realiza la conexion con la base de datos
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	//se realiza la consulta para eliminiar todos los datos del paciente, seleccionado en la tabla de pacientes de la pestaña pacientes.
	$sql="DELETE FROM pacientes WHERE idPaciente = '$_REQUEST[idPaciente]'";
	$resultado = $conexion->query($sql);

	if($resultado == true){
		//se regresa a la pagina de pacientes
		header('Location: Pacientes.php');
		$errores .='Paciente eliminado correctamente';
	}
?>