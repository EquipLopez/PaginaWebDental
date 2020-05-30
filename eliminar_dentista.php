<?php
	$errores='';
	extract ($_REQUEST);
	try{
		//se realiza la conexion con la base de datos
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	//se realiza la consulta para eliminiar todos los datos del dentista  que se selecciono en la tabla de dentistas de la pestaña dentista mediante el id del dentista.
	$sql="DELETE FROM dentistas WHERE idDentista = '$_REQUEST[idDentista]'";
	$resultado = $conexion->query($sql);
     // se hace la comparcion para si se guarda los datos o no.
	if($resultado == true){
		//se regresa a la pestaña de dentista
		header('Location: dentistas.php');
		$errores .='Dentista eliminado correctamente';
	}
?>