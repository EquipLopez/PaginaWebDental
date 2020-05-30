<?php
	$mensaje='';
	extract ($_REQUEST);
	try{
		//se realiza la conexion con la base de datos dentalcenter
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	//se realiza la consulta para eliminiar todos los datos del consultorio seleccionado en la tabla de consultorio de la pestaña de consultorios.
	$sql="DELETE FROM consultorios WHERE idconsultorio = '$_REQUEST[idConsultorio]'";
	$resultado = $conexion->query($sql);
    // se hace una comparacion de la consulta en cual si esta bien se pasa a otra pestaña.
	if($resultado == true){
		//se regresa a la pagina de citas
		header('Location: consultorios.php');
		$mensaje .='Consultorio eliminado correctamente';
	}
?>