
<?php session_start(); // se utiliza para iniciar una nueva sesion o reanudar una exitente.


// se hace la comparcion del nombre del usuario para poder ingresar.
if (isset($_SESSION['usuario'])){
	//una vez iniciada la sesion de envia a la pestaña de principal.
	header('Location: index.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	// se crean las siguientes variables para almacenar la contraseña y el nombre del usuario.
	$usuario = filter_var(strtolower($_POST['usuario']),FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password = hash('sha512', $password);
	$errores ='';	

	try{
		//se realiza la conexion con la base de datos que queremos obtener los datos.
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	$statement = $conexion -> prepare(
		//se realiza la siguiente consulta para comparar el usuario y contaseña, con los datos almacenados en la base de datos.
			'SELECT * FROM usuarios WHERE usuario = :usuario AND pass= :password');

	$statement ->execute(array(':usuario'=> $usuario,':password'=> $password));

	$resultado = $statement->fetch();
	//se compara la variable donde guardamos la consulta
	if($resultado !==false){
		//en caso de que la variable sea igual a verdadero, se iniciara la sesion.
		$_SESSION['usuario'] = $usuario;
		//una vez iniciada la sesion se enviara a la pestaña de index.
		header('Location: index.php');
	}else{
		//se muestra este mensaje cuando la comparacion de la variable no coincida con los datos de la base de datos.
		$errores .= 'Datos incorrectos y/o invalidos!';
	}
}
   //requiere la pestaña de la vista donde se el formulario de login
	require 'vista/login.php';
?>