<?php session_start();
	if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
	}
	require 'funciones.php';
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessge();
		die();
	}
	//se crean las siguientes varibles para guardar los datos de los usuarios que se ingresaron en el formulario de usuarios.
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$id = limpiarDatos($_POST['id']);
		$usuario = limpiarDatos($_POST['usuario']);
		$nombres = limpiarDatos($_POST['nombres']);
		$apellidos = limpiarDatos($_POST['apellidos']);
		$roll = limpiarDatos($_POST['roll']);
		
		//se realiza la consulta para modificar los datos del formulario de usuarios por otros datos nuevos.
		$statement = $conexion->prepare(
		"UPDATE usuarios
        SET usuario = :usuario, 
		nombres =:nombres, 
		apellidos =:apellidos, 
		Roll =:roll
		WHERE id = :id");

		$statement ->execute(array(
		':usuario'=>$usuario, 
		':nombres'=>$nombres, 
		':apellidos'=>$apellidos, 
		':roll'=>$roll, 
        ':id'=> $id
        ));
        //se regresa a la pagina de citas
        header('Location: usuarios.php');
	}else{
		$id_usuario = id_numeros($_GET['id']);
		if(empty($id_usuario)){
			header('Location: usuarios.php');
		}
		$user = obtenerUser_id($conexion,$id_usuario);
		
		if(!$user){
			header('Location: usuarios.php');
		}
		$user =$user[0];
	}
	require 'vista/actualizarusuario_vista.php';
?>