<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	//se crean las siguientes varibles para guardar los datos del consultorio que se ingresaron en el formulario de consultorios. 
	$nombre = filter_var(strtolower($_POST['nombre']),FILTER_SANITIZE_STRING);
	$mensaje='';
		try{
			//se hace la conexion con la base de datos
			$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

	if($mensaje==''){
		//se realiza la consulta para guardar los datos ingresados en formulario de consultorios en la base de datos.
		$statement = $conexion->prepare(
		"INSERT INTO consultorios
		values(null,:nombre)");

		$statement ->execute(array( 
		':nombre'=> $nombre
		));
		header('Location: consultorios.php');
	}
}
require 'vista/agg_consultorios_vista.php';
?>