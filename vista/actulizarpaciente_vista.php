<?php include 'plantillas/header.php'; 
	$mensaje='';
	try{
		$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
	}catch(PDOException $e){
		echo "Error: ". $e->getMessage();
	}
	
	//cargar el sexo en el select que esta en el formulario
	$sexo = $conexion -> prepare("SELECT DISTINCT pacSexo FROM pacientes");
	
	$sexo ->execute();
	$sexo = $sexo ->fetchAll();
	if(!$sexo)
		$mensaje .= 'NO hay especialidades, por favor registre!';
?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>Pacientes</h2>
					</div>
					<!--se crea un nuevo formulario para modificar los datos del paciente-->
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>EDITAR PACIENTE</h2>
						<input type="hidden" name="id" value="<?php echo $paciente['idPaciente'];?>" />
						<!-- en esta caja de texto se muestra la identificacion del paciente seleccionado-->
						<input type="numeric" name="identificacion" placeholder="Identificación" value="<?php echo $paciente['pacIdentificacion'];?>">
						<!-- en esta caja de texto se muestra el nombre del paciente seleccionado-->
						<input type="text" name="nombre" placeholder="Nombres:" value="<?php echo $paciente['pacNombre'];?>">
						<!-- en esta caja de texto se muestra el apellido del paciente seleccionado-->
						<input type="text" name="apellidos" placeholder="Apellidos:" value="<?php echo $paciente['pacApellidos'];?>">
						<!-- en esta caja de texto se muestra la fecha de nacimiento del paciente seleccionado-->
						<input type="date" name="fechaNacimiento" placeholder="Fecha Nacimiento:" value="<?php echo $paciente['pacFechaNacimiento'];?>">
							<!-- en este select se muestra el sexo del paciente seleccionados-->
						<select name="sexo">
							<option value="<?php echo $paciente['pacSexo'];?>"><?php echo $paciente['pacSexo'];?></option>
							<?php foreach ($sexo as $Sql): ?>
							<?php echo "<option value='". $Sql['pacSexo']. "'>". $Sql['pacSexo']. "</option>"; ?>
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
                    <a class="btn-regresar" href="pacientes.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>