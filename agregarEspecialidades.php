<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	//se crean las siguientes varibles para guardar los datos de la especialidad que se ingresaron en parte del formulario de especialidades.
	$nombre = filter_var(strtolower($_POST['nombre']),FILTER_SANITIZE_STRING);
	$mensaje='';
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

	if($mensaje==''){
		//se realiza la consulta para guardar los datos ingresados en formulario de especialidades en la base de datos.
		$statement = $conexion->prepare("INSERT INTO especialidades values(null,:nombre)");

		$statement ->execute(array( 
		':nombre'=> $nombre
		));
		header('Location: especialidades.php');
	}
}
require 'vista/agg_especialidades_vista.php';
?>