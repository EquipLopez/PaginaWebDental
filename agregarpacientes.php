<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	//se crean las siguientes varibles para guardar los datos de los pacientes que se ingresaron en el formulario de pacientes.
	$nombre = filter_var(strtolower($_POST['nombre']),FILTER_SANITIZE_STRING);
	$apellidos = $_POST['apellidos'];
	$identificacion =  $_POST['identificacion'];
	$sexo =  $_POST['sexo'];
	$fecha =  $_POST['fechaNacimiento'];
	$mensaje='';
	//se hace una comparcion para que los campos no esten vacios y tengan datos para poder guardarlos en la base de datos.
	if(empty($nombre) or empty($apellidos)  or empty($identificacion)){
		$mensaje.= 'Por favor rellena todos los datos correctamente'."<br />";
	}
	else{	
		try{
			//se hace la conexion con la base de datos
			$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
		}catch(PDOException $e){
			echo "Error: ". $e->getMessage();
			die();
		}

		$statement = $conexion -> prepare(
			//se realiza la consulta para obtener todos los datos del paciente mediante el id.
			'SELECT * FROM pacientes WHERE idPaciente = :id LIMIT 1');
		$statement ->execute(array(':id'=>$identificacion));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='Ya existe un paciente con esa identificación </br>';
		}
	}
	if($mensaje==''){
		//se realiza la consulta para guardar los datos ingresados en el formulario de pacientes en la base de datos.
		$statement = $conexion->prepare(
		'INSERT INTO pacientes
		values(null, :id,:nombre,:apellidos,:fecha,:sexo)');

		$statement ->execute(array(
		':id'=>$identificacion,
		':nombre'=> $nombre,
		':apellidos'=>$apellidos,
		':fecha'=>$fecha,
		':sexo'=>$sexo
		));
		header('Location: pacientes.php');
	}
}
require 'vista/agg_pacientes_vista.php';
?>