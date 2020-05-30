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
		//se crean las siguientes varibles para guardar los datos del consultorio seleccionado en la tabla de consultorios.
		$id = limpiarDatos($_POST['id']);
		$nombres = limpiarDatos($_POST['nombre']);
		
		//se realiza la consulta para modificar los datos del formulario con otrso datos nuevos.
		$statement = $conexion->prepare(
		"UPDATE consultorios SET
		conNombre = :nombres
		WHERE idConsultorio =:id");

		$statement ->execute(array(
			':id'=>$id,
			':nombres'=>$nombres
			));
		//se regresa a la pagina de consultorios 
        header('Location: consultorios.php');
	}else{
		$id_consultorio = id_numeros($_GET['idConsultorio']);
		if(empty($id_consultorio)){
			header('Location: consultorios.php');
		}
		$consultorio = obtener_consultorio_id($conexion,$id_consultorio);
		
		if(!$consultorio){
			header('Location: consultorios.php');
		}
		$consultorio =$consultorio[0];
	}
	require 'vista/actualizarconsultorio_vista.php';
?>