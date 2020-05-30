<?php include 'plantillas/header.php'; 

$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

////se realiza la consulta para obtener todos los datos de la tabla especialidades
$especialidad = $conexion -> prepare("SELECT * FROM especialidades");

$especialidad ->execute();
$especialidad = $especialidad ->fetchAll();
if(!$especialidad)
	$mensaje .= 'NO hay especialidades, por favor registre!';

?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Dentistas</h2>
					</div>
					<!--se crea un nuevo formulario para modificar los datos de los dentistas-->
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>EDITAR DENTISTA</h2>
						<input type="hidden" name="id" value="<?php echo $dentista['idDentista'];?>" />
						<!-- en esta caja de texto se muestra la identificacion del dentista  seleccionado-->
						<input type="numeric" name="identificacion" placeholder="Identificación" value="<?php echo $dentista['denIdentificacion	'];?>" requerid>
						<!-- en esta caja de texto se muestra el nombre del dentista  seleccionado-->
						<input type="text" name="nombres" placeholder="Nombres:" value="<?php echo $dentista['denNombres'];?>">
						<!-- en esta caja de texto se muestra el apellido del dentista  seleccionado-->
						<input type="text" name="apellidos" placeholder="Apellidos:" value="<?php echo $dentista['denApellidos'];?>">
						<!-- en esta caja de texto se muestra el correo del dentista  seleccionado-->
						<input type="email" name="correo" placeholder="Correo:" value="<?php echo $dentista['denCorreo'];?>">
						<!-- en esta caja de texto se muestra el telefono del dentista  seleccionado-->
						<input type="numeric" name="telefono" placeholder="Telefono:" value="<?php echo $dentista['denTelefono'];?>">
						<!-- en este select se muestra la especialidad del paciente seleccionado-->
						<select name="especialidad">
							<option value="<?php echo $dentista['denEspecialidad'];?>"><?php echo $dentista['denEspecialidad'];?></option>
							<?php foreach ($especialidad as $Sql): ?>
							<?php echo "<option value='". $Sql['espNombre']. "'>". $Sql['espNombre']. "</option>"; ?>
							<?php endforeach; ?>
						</select>
						<!--este un boton el cual envia los nuevos datos actualizados del formulario para ser guardados-->
						<input type="submit" name="enviar" value="Actualizar">
						
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
                    <a class="btn-regresar" href="dentistas.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>