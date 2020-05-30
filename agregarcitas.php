<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}


if($_SERVER['REQUEST_METHOD']=='POST'){
	//se crean las siguientes varibles para guardar los datos de la citas que se  ingresaron en parte del formulario de citas
	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$paciente =  $_POST['paciente'];
	$dentista =  $_POST['dentista'];
	$consultorio =  $_POST['consultorio'];
	$estado =  $_POST['estado'];
	$observaciones =  $_POST['observaciones'];
	$mensaje='';
	//se hace una comparcion para que los campos no esten vacios y tengan datos para poder guardarlos.
	if(empty($fecha) or empty($hora)  or empty($consultorio) or empty($paciente) or empty($estado)or empty($dentista)){
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
	}
	if($mensaje==''){
		//se realiza la consulta para guardar los datos ingresados en formulario de citas en la base de datos.
		$statement = $conexion->prepare(
		'INSERT INTO citas (idcita,citfecha,cithora,citPaciente,cidDentista,citConsultorio,citestado,citobservaciones)
		values(null, :fecha,:hora,:paciente,:dentista,:consultorio,:estado,:observaciones)');

		$statement ->execute(array(
		':fecha'=>$fecha,
		':hora'=>$hora,
		':paciente'=>$paciente,
		':dentista'=>$dentista,
		':consultorio'=>$consultorio,
		':estado'=>$estado,
		':observaciones'=>$observaciones
		));
		header('Location: citas.php');
	}
}
require 'vista/agregarcitas_vista.php';
?>