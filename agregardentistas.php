<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	//se crean las siguientes varibles para guardar los datos de los dentistas que se ingresaron en parte del formulario de dentistas.
	$nombre = filter_var(strtolower($_POST['nombres']),FILTER_SANITIZE_STRING);
	$apellidos = $_POST['apellidos'];
	$correo =  $_POST['correo'];
	$identificacion =  $_POST['identificacion'];
	$especialidad =  $_POST['especialidad'];
	$telefono =  $_POST['telefono'];
	$mensaje='';
	//se hace una comparcion para que los campos no esten vacios y tengan datos para poder guardarlos.
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
			//se realiza la consulta para obtener todos los datos de tabla dentista de la base de datos mediante el id.

			'SELECT * FROM dentistas WHERE idDentista = :id LIMIT 1');
		$statement ->execute(array(':id'=>$identificacion));
		$resultado= $statement->fetch();

		if($resultado != false){
			$mensaje .='El nombre de usuario ya existe </br>';
		}
	}
	if($mensaje==''){
		$statement = $conexion->prepare(
			//se realiza la consulta para guardar los datos ingresados en formulario en la tabla llamada pacientes de la base de datos.
		'INSERT INTO dentistas (idDentista,denIdentificacion	,denNombres,denApellidos,
		denEspecialidad,denTelefono,denCorreo)
		values(null, :id,:nombre,:apellidos,:especialidad,:telefono,:correo)');

		$statement ->execute(array(
		':id'=>$identificacion,
		':nombre'=> $nombre,
		':apellidos'=>$apellidos,
		':especialidad'=>$especialidad,
		':telefono'=>$telefono,
		':correo'=>$correo
		));
		header('Location: dentistas.php');
	}
}
require 'vista/agg_dentistas_vista.php';
?>