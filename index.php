
<?php session_start();
//se hace una comparacion de los datos ingresados 
if (isset($_SESSION['usuario'])){
	//nen caso 
	header('Location: DentalCenter.php');
}else{
	header('Location: login.php');
}	
?>