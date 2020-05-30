<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}


if($_SERVER['REQUEST_METHOD']=='POST'){
	//se crean las siguientes varibles para guardar los datos de los usuarios que se ingresaron en el formulario de usuarios.
	$usuario = filter_var(strtolower($_POST['usuario']),FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $roll = $_POST['roll'];
	$errores ='';
	//se hace una comparcion para que los campos no esten vacios y tengan datos para poder guardarlos.
	if(empty($usuario) or empty($password)){
		$errores.= '<li>Por favor rellena todos los tados correctamente</li>';
	}
	else{
		try{
			//se hace la conexion con la base de datos
			$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
		}catch(PDOException $e){
			echo "ERROR: " . $e->getMessge();
			die();
		}
		//esta consulta selecciona los datos de los usuarios.
		$statement = $conexion -> prepare(
			'SELECT * FROM usuarios WHERE UsuNombre = :usuario LIMIT 1');
		$statement ->execute(array(':usuario'=>$usuario));
		$resultado= $statement->fetch();
        
        //se realiza un comparacion para que el nombre de un usuario sea unico en caso de ser uno que ya exita se mostrara un mensaje.
		if($resultado != false){
			$errores .='<li>El nombre de usuario ya existe</li>';
		}

         //se crean las contaseñas del usuario por el metodo de hash
		$password = hash('sha512',$password);
		$password2 = hash('sha512',$password2);
        
        //se hace la comparcion de dos contaseñas que deben de coincidir para poderse guardar
        //en caso de que sean diferentes se mostrar un mensaje 
		if($password2 != $password){
			$errores .= '<li>Las contraseñas no son iguales</li>';
		}
	}

	if($errores==''){
		//se realiza la consulta para guardar los datos ingresados en formulario de usuarios en la base de datos.
		$statement = $conexion->prepare(
			'INSERT INTO usuarios VALUES
            (null,:usuario,:pass, :nombres, :apellidos,:roll)');
		$statement-> execute(array(
			':usuario' => $usuario,
			':pass'=> $password2,
            ':nombres'=> $nombres,
            ':apellidos'=> $apellidos,
            ':roll'=> $roll
			));
		header('Location: usuarios.php');
	}
}
require 'vista/registro_vista.php';

?>