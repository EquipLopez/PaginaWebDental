<?php
$mensaje='';
try{
	//se realiza la conexion con la base de datos dentalcenter, mediante el nombre de la base, el usuario, contraseña y el host.
	$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//se realiza la consulta para obtener toda la informacion de la tabla citas por el orden del id. 
$consulta = $conexion -> prepare("
		SELECT 	* FROM citas order by idcita");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
//se realiza la comparacion de la consulta para ver si exite informacion en la tabla llamada citas.
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<!--este un link en cual nos envia a otra pesataña llamada agregar nueva citas-->
					<a class="agregar" href="agregarcitas.php">Agregar Citas</a>
					<!--creamos una tabla-->
					<table class="tabla">
						<!---->
						  <tr>
							<th>#</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Paciente</th>
							<th>Dentista</th>
							<th>Consultorio</th>
							<th>Estado</th>
							<th colspan="2">Opciones</th>
						  </tr> 
						  <!-- se llama a la varible donde guardamos la consulta para mostrar todos los datos en los campos de la tabla creada -->
						<?php foreach ($consulta as $Sql): ?>
						<tr>
							<!--se muestran los datos para campo de la tabla.-->
						<?php echo "<td class='mayusculas'>". $Sql['idcita']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citfecha']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['cithora']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citPaciente']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['cidDentista']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citConsultorio']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citestado']. "</td>"; ?>
						<!--este es un boton el cual nos envia a la pestaña de actualizar citas-->
                        <?php echo "<td class='centrar'>"."<a href='actualizarcitas.php?idcita=".$Sql['idcita']."' class='editar'>Editar</a>". "</td>"; ?>
                        <!--este boton tiene la funcion de elminiar los datos de una fila-->
						<?php echo "<td class='centrar'>"."<a href='eliminar_citas.php?idcita=".$Sql['idcita']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
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