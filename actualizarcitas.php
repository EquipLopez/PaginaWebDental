<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	
	require 'funciones.php';
	
	try{
		//se realiza la conexion con la base de datos
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//se crean las siguientes varibles para guardar los datos de la cita seleccionada de la tabla de citas ubica en pestaña de citas
		$id = limpiarDatos($_POST['id']);
		$fecha = limpiarDatos($_POST['fecha']);
        $hora = limpiarDatos($_POST['hora']);
        $paciente = limpiarDatos($_POST['paciente']);
        $dentista = limpiarDatos($_POST['dentista']);
        $consultorio = limpiarDatos($_POST['consultorio']);
        $estado = limpiarDatos($_POST['estado']);
        $observaciones = limpiarDatos($_POST['observaciones']);
		
		//se realiza la consulta para modificar los datos del formulario de citas.
		$statement = $conexion->prepare(
		"UPDATE citas 
		SET citfecha = :fecha,
        cithora = :hora,
        citPaciente = :paciente,
        cidDentista = :dentista,
        citConsultorio = :consultorio,
        citestado = :estado,
        citobservaciones = :observaciones,
		WHERE idcita =:id");

		$statement ->execute(array(
			':id'=>$id,
			':fecha'=> $fecha,
            ':hora'=> $hora,
            ':paciente'=> $paciente,
            ':dentista'=> $dentista,
            ':consultorio'=> $consultorio,
            ':estado'=> $estado,
            ':observaciones'=> $observaciones
			));
		//se regresa a la pagina de citas
        header('Location: citas.php');
	}else{
		$id_cita = id_numeros($_GET['idcita']);
		if(empty($id_cita)){
			header('Location: citas.php');
		}
		$cita = obtener_cita_id($conexion,$id_cita);
		
		if(!$cita){
			header('Location: citas.php');
		}
		$cita =$cita[0];
	}
	require 'vista/actualizarcitas_vista.php';
?>