<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	
	require 'funciones.php';
	//se realiza la conexion con la base de datos
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//se crean las siguientes varibles para guardar los datos del dentista que se selecciono en la tabla de dentistas ubica en pestaña de dentista
		$id = limpiarDatos($_POST['id']);
		$identificacion = limpiarDatos($_POST['identificacion']);
		$nombres = limpiarDatos($_POST['nombres']);
		$apellidos = limpiarDatos($_POST['apellidos']);
		$correo = limpiarDatos($_POST['correo']);
		$telefono = limpiarDatos($_POST['telefono']);
		$especialidad = limpiarDatos($_POST['especialidad']);
		
		//se realiza la consulta para modificar los datos del formulario y guardarlos los nuevos datos en la base de datos.
		$statement = $conexion->prepare(
		"UPDATE dentistas
        SET denIdentificacion	 = :identificacion, 
		denNombres =:nombres, 
		denApellidos =:apellidos, 
		denEspecialidad =:especialidad, 
		denTelefono =:telefono, 
		denCorreo =:correo 
		WHERE idDentista = :id");

		$statement ->execute(array(
        ':identificacion'=>$identificacion, 
		':nombres'=>$nombres, 
		':apellidos'=>$apellidos, 
		':especialidad'=>$especialidad, 
		':telefono'=>$telefono, 
		':correo'=>$correo,
        ':id'=> $id
        ));
        //se regresa a la pagina de dentistas
        header('Location: dentistas.php');
	}else{
		$id_dentista = id_numeros($_GET['idDentista']);
		if(empty($id_dentista)){
			header('Location: dentistas.php');
		}
		$dentista = obtener_dentista_id($conexion,$id_dentista);
		
		if(!$dentista){
			header('Location: dentistas.php');
		}
		$dentista =$dentista[0];
	}
	require 'vista/actulizardentista_vista.php';
?>