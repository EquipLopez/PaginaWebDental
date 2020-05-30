<?php
$mensaje='';
try{
	//se realiza la conexion con la base de datos dentalcenter, mediante el nombre de la base, el usuario, contraseña y el host.
	$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//se realiza la consulta para obtener toda la informacion de la tabla dentistas por el orden del id. 
$consulta = $conexion -> prepare("
	SELECT * FROM dentistas ORDER BY denIdentificacion	");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
//se realiza la comparacion de la consulta para ver si exite informacion en la tabla llamada dentistas.
if(!$consulta){
	$mensaje .= 'NO HAY DENTISTAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>DENTISTAS</h2>
					</div>
					<!--este un link en cual nos envia a otra pesataña llamada agregar dentistas-->
						<a href="agregardentistas.php"class="agregar">Agregar dentista</a>
						<!--creamos una tabla-->
						<table class="tabla">
						  <tr>
							<th>Identificacion</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Correo</th>
							<th>Especialidad</th>
							<th colspan ="2">Opciones</th>
							 <!-- se llama a la varible donde guardamos la consulta para mostrar todos los datos en los campos de la tabla creada -->

						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr >
							<!--se muestran los datos para campo de la tabla.-->
						<?php echo "<td class='mayusculas'>". $Sql['denIdentificacion']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['denNombres']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['denApellidos']. "</td>"; ?>
						<?php echo "<td>". $Sql['denCorreo']. "</td>"; ?>
						<?php echo "<td >". $Sql['denEspecialidad']. "</td>"; ?>
						<!--este es un boton el cual nos envia a la pestaña de actualizar dentistas-->
						<?php echo "<td class='centrar'>"."<a href='actualizardentista.php?idDentista=".$Sql['idDentista']."' class='editar'>Editar</a>". "</td>"; ?>
						<!--este boton tiene la funcion de elminiar los datos de una fila-->
						<?php echo "<td class='centrar'>"."<a href='eliminar_dentista.php?idDentista=".$Sql['idDentista']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
						</tr>
						<?php endforeach; ?>
						</table>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>