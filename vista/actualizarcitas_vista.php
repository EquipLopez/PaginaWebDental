<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//se realiza la consulta para obtener todos los datos de la tabla dentista.
$dentistas = $conexion -> prepare("SELECT * FROM dentistas");

$dentistas ->execute();
$dentistas = $dentistas ->fetchAll();
if(!$dentistas)
	$mensaje .= 'No hay dentistas, por favor registre primero! <br />';
//se realiza la consulta para obtener todos los datos de la tabla consultorios.
$consultorios = $conexion -> prepare("SELECT * FROM consultorios");

$consultorios ->execute();
$consultorios = $consultorios ->fetchAll();
if(!$consultorios)
	$mensaje .= 'No hay consultorios, por favor registre primero! <br />';
//se realiza la consulta para obtener todos los datos de la tabla pacientes.
$pacientes = $conexion -> prepare("SELECT * FROM pacientes");

$pacientes ->execute();
$pacientes = $pacientes ->fetchAll();
if(!$pacientes)
	$mensaje .= 'No hay pacientes, por favor registre primero! <br />';

?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<!--se crea un nuevo formulario para modificar los datos de la citas-->
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Actualizar Citas</h2>
						<label>Fecha:</label>
						<input type="hidden" name="id" value="<?php echo $cita['idcita'];?>" >
						<!-- en esta caja de texto se muestra la fecha de la cita de la cita seleccionada-->
                        <input type="date" name="fecha" placeholder="Fecha:" value="<?php echo $cita['citfecha'];?>" required/>
                        <label>Hora:</label>
                        <!-- en esta caja de texto se muestra la hora de la cita de la cita seleccionada-->
                        <input type="time" name="hora" max="20:00" min="08:00" step="60" value="<?php echo $cita['cithora'];?>" required>
                        <label>Paciente:</label>
                        <!-- en este select se muestra el nombre del paciente de la cita seleccionada-->
                        <select name="paciente" class="mayusculas" required>
                        	<option value="<?php echo $cita['citPaciente'];?>"><?php echo $cita['citPaciente'];?></option> 
	                        <?php foreach ($pacientes as $Sql2): ?>
							<?php echo "<option value='". $Sql2['pacNombre']. "'>". $Sql2['pacNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Dentistas:</label>
                        <!-- en este select se muestra el nombre del paciente de la cita seleccionada-->
                        <select name="dentista" class="mayusculas" required>
                        	<option value="<?php echo $cita['cidDentista'];?>"><?php echo $cita['cidDentista'];?></option>  
	                        <?php foreach ($dentistas as $Sql): ?>
							<?php echo "<option value='". $Sql['denNombres']. "'>". $Sql['denNombres']." ". $Sql['denApellidos']. "</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Consultorios:</label>
                        <!-- en este select se muestra el nombre del consultorio de la cita seleccionada-->
                        <select name="consultorio" class="mayusculas" required>
                        	<option value="<?php echo $cita['citConsultorio'];?>"><?php echo $cita['citConsultorio'];?></option> 
	                        <?php foreach ($consultorios as $Sql2): ?>
							<?php echo "<option value='". $Sql2['conNombre']. "'>". $Sql2['conNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Estado:</label required>
                        	<!-- en este select se muestra el estado de la cita seleccionada-->
                        <select name="estado">
                        if (<?php echo $cita['cidDentista'];?>=asignado){
                        	<option value="asignado">Asignado</option>
                        	<option value="atendido">Atendido</option> 
                        }
                        if (<?php echo $cita['cidDentista'];?>=atendido){
                        	<option value="atendido">Atendido</option> 
                        	<option value="asignado">Asignado</option>
                        }
                                   	
                        </select>
                        <label>Observaciones:</label>
                        <!-- en esta caja de texto se muestra las observaciones de la cita seleccionada-->
                        <textarea name="observaciones" value="<?php echo $cita['citobservaciones'];?>"></textarea>
                        <!--este un boton el cual envia los nuevos datos actualizados del formulario para ser guardados-->
						<input type="submit" name="enviar" value="Actualizar Cita">
					</form>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>
					<a class="btn-regresar" href="citas.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>