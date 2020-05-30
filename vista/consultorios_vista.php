<?php
$mensaje='';
try{
	//se realiza la conexion con la base de datos dentalcenter, mediante el nombre de la base, el usuario, contraseña y el host.
	$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//se realiza la consulta para obtener toda la informacion de la tabla consultorios por el orden del id. 
$consulta = $conexion -> prepare("
	SELECT * FROM consultorios order by idconsultorio limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
//se realiza la comparacion de la consulta para ver si exite informacion en la tabla llamada consultorios.
if(!$consulta){
	$mensaje .= 'NO HAY CONSULTORIOS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	</div>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CONSULTORIOS</h2>
					</div>
					<!--este un link en cual nos envia a otra pesataña llamada agregar consultorios-->
						<a class="agregar" href="agregarconsultorios.php">Agregar Consultorio</a>
						<!--creamos una tabla-->
						<table class="tabla">
						  <tr>
							<th>#</th>
							<th>Nombre</th>
							<th colspan="2">Opciones</th>
						  </tr>
						   <!-- se llama a la varible donde guardamos la consulta para mostrar todos los datos en los campos de la tabla creada -->
						<?php foreach ($consulta as $Sql): ?>
						<tr>
							<!--se muestran los datos para campo de la tabla.-->
						<?php echo "<td>". $Sql['idConsultorio']. "</td>"; ?>
						<?php echo "<td>". $Sql['conNombre']. "</td>"; ?>
						<!--este es un boton el cual nos envia a la pestaña de actualizar consultorios-->
                        <?php echo "<td class='centrar'>"."<a href='actualizarconsultorio.php?idConsultorio=".$Sql['idConsultorio']."' class='editar'>Editar</a>". "</td>"; ?>
                        <!--este boton tiene la funcion de elminiar los datos de una fila-->
						<?php echo "<td class='centrar'>"."<a href='eliminar_consultorio.php?idConsultorio=".$Sql['idConsultorio']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
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