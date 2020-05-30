<?php
$mensaje='';
try{
	//se realiza la conexion con la base de datos dentalcenter, mediante el nombre de la base, el usuario, contraseña y el host.
	$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//se realiza la consulta para obtener toda la informacion de la tabla pacientes por el orden del id. 
$consulta = $conexion -> prepare("
	SELECT * FROM pacientes");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
//se realiza la comparacion de la consulta para ver si exite informacion en la tabla llamada pacientes.
if(!$consulta){
	$mensaje .= 'NO HAY PACIENTES PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	</div>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>PACIENTES</h2>
					</div>
					<!--este un link en cual nos envia a otra pesataña llamada aggregar pacientes-->
					<a class="agregar" href="agregarpacientes.php">Agregar Paciente</a>
					<!--creamos una tabla donde mostraremos todos los datos-->
					<table class="tabla">
						  <tr>
							<th>Identificacion</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Fecha Nacimiento</th>
							<th>Sexo</th>
							<th colspan="2">Opciones</th>
						  </tr>
						  <!-- se llama a la varible donde guardamos la consulta para mostrar todos los datos en los campos de la tabla creada -->
						<?php foreach ($consulta as $Sql): ?>
						<tr>
							<!--se muestran los datos para cada campo de la tabla .-->
							<?php echo "<td>". $Sql['pacIdentificacion']. "</td>"; ?>
							<?php echo "<td>". $Sql['pacNombre']. "</td>"; ?>
							<?php echo "<td>". $Sql['pacApellidos']. "</td>"; ?>
							<?php echo "<td>". $Sql['pacFechaNacimiento']. "</td>"; ?>
							<?php echo "<td>". $Sql['pacSexo']. "</td>"; ?>
							<!--este es un boton el cual nos envia a la pestaña de actualizar pacientes-->
                            <?php echo "<td class='centrar'>"."<a href='actualizarpaciente.php?idPaciente=".$Sql['idPaciente']."' class='editar'>Editar</a>". "</td>"; ?>
                            <!--este boton tiene la funcion de elminiar todos los datos de una fila seleccionada-->
                          <?php echo "<td class='centrar'>"."<a href='eliminar_paciente.php?idPaciente=".$Sql['idPaciente']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
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