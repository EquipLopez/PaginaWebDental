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
		//se crean las siguientes varibles para guardar los datos del paciente que se selecciono de la tabla de pacientes ubica en pestaña de pacientes
		$id = limpiarDatos($_POST['id']);
		$identificacion = limpiarDatos($_POST['identificacion']);
		$nombre = limpiarDatos($_POST['nombre']);
		$apellidos = limpiarDatos($_POST['apellidos']);
		$fecha = limpiarDatos($_POST['fechaNacimiento']);
		$sexo = limpiarDatos($_POST['sexo']);
		
		//se realiza la consulta para modificar los datos del formulario de pacientes por otros datos nuevos.
		$statement = $conexion->prepare(
		"UPDATE pacientes
        SET pacIdentificacion = :identificacion, 
		pacNombre =:nombre, 
		pacApellidos =:apellidos, 
		pacFechaNacimiento =:fechaNacimiento, 
		pacSexo =:sexo
		WHERE idPaciente = :id");

		$statement ->execute(array(
        ':identificacion'=>$identificacion, 
		':nombre'=>$nombre, 
		':apellidos'=>$apellidos, 
		':fechaNacimiento'=>$fecha, 
		':sexo'=>$sexo,
        ':id'=> $id
        ));
        //se regresa a la pagina de pacientes
        header('Location: pacientes.php');
	}else{
		$id_paciente = id_numeros($_GET['idPaciente']);
		if(empty($id_paciente)){
			header('Location: pacientes.php');
		}
		$paciente = obtener_paciente_id($conexion,$id_paciente);
		
		if(!$paciente){
			header('Location: pacientes.php');
		}
		$paciente =$paciente[0];
	}
	require 'vista/actulizarpaciente_vista.php';
?>