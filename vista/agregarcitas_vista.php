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
					<!--se crea un nuevo formulario para agregar nuevas citas a la base -->
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>Agregar Citas</h2>
						<label>Fecha:</label>
						 <!-- se crea esta caja de texto para seleccionar la fecha de la cita-->
                        <input type="date" name="fecha" placeholder="Fecha:" required/>
                        <label>Hora:</label>
                        <!-- se crea esta caja de texto para seleccionar la hora de la cita-->
                        <input type="time" name="hora" value="11:45" max="20:30" min="08:00" step="60" required>
                        <label>Paciente:</label>
                        <!--se crea el select para mostrar los pacientes que ya estan registrados en la pagina  -->
                        <select name="paciente" class="mayusculas" required> 
	                        <?php foreach ($pacientes as $Sql2): ?>
							<?php echo "<option value='". $Sql2['pacNombre']. "'>". $Sql2['pacNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Dentista:</label>
                        <!--se crea el select para mostrar los dentistas que ya estan registrados en la pagina  -->
                        <select name="dentista" class="mayusculas" required> 
	                        <?php foreach ($dentistas as $Sql): ?>
							<?php echo "<option value='". $Sql['denNombres']. "'>". $Sql['denNombres']." ". $Sql['denApellidos']. "</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Consultorios:</label>
                        <!--se crea el select para mostrar los consultorios que ya estan registrados en la pagina  -->
                        <select name="consultorio" class="mayusculas" required> 
	                        <?php foreach ($consultorios as $Sql2): ?>
							<?php echo "<option value='". $Sql2['conNombre']. "'>". $Sql2['conNombre']."</option>"; ?>
							<?php endforeach; ?>
                        </select>
                        <label>Estado:</label required>
                        	<!--se crea el select para seleccionar el estado de la nueva cita -->
                        <select name="estado">
                        	<option value="asignado">Asignado</option>
                        	<option value="atendido">Atendido</option>                    	
                        </select>
                        <label>Observaciones:</label>
                        <!--se crea la caja de texto para que se pueden agregar las observaciones sobre la cita-->
                        <textarea placeholder="Observacion:" name="observaciones"></textarea>
                        <!--este un boton el cual envia todos los datos del formulario para ser guardados-->
						<input type="submit" name="enviar" value="Agregar Cita">
					</form>
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