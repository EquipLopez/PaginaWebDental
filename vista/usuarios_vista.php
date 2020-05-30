<?php
$mensaje='';
try{
	//se realiza la conexion con la base de datos dentalcenter, mediante el nombre de la base, el usuario, contraseña y el host.
	$conexion = new PDO('mysql:host=localhost;dbname=dentalcenter','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}
//se realiza la consulta para obtener toda la informacion de la tabla de usuarios por el orden del id. 
$consulta = $conexion -> prepare("
	SELECT * FROM usuarios limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
//se realiza la comparacion de la consulta para ver si exite informacion en la tabla llamada usuarios.
if(!$consulta){
	$mensaje .= 'NO HAY USUARIOS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>USUARIOS</h2>
					</div>
					<!--este un link en cual nos envia a otra pesataña llamada agregar usuarios-->
					<a class="agregar" href="registrarusuarios.php">Agregar Usuarios</a>
					<!--creamos una tabla -->
						<table class="tabla">
						  <tr>
							<th>Nombres</th>
							<th>Apellidos</th>
                            <th>Usuario</th>
							<th>Roll</th>
                            <th colspan="2">Opciones</th>
						  </tr>
						    <!-- se llama a la varible donde guardamos la consulta para mostrar todos los datos en los campos de la tabla creada -->
						<?php foreach ($consulta as $Sql): ?>
						<tr>
							<!--se muestran todos los datos para campo de la tabla.-->
							<?php echo "<td>". $Sql['nombres']. "</td>"; ?>
                            <?php echo "<td>". $Sql['apellidos']. "</td>"; ?>
                            <?php echo "<td>". $Sql['usuario']. "</td>"; ?>
                            <?php echo "<td>". $Sql['Roll']. "</td>"; ?>
                            <!--este es un boton el cual nos envia a la pestaña de actualizar usuarios-->
                            <?php echo "<td class='centrar'>"."<a href='actualizarusuario.php?id=".$Sql['id']."' class='editar'>Editar</a>". "</td>"; ?>
                            <!--este boton tiene la funcion de elminiar todos los datos de una fila seleccionada-->
						  <?php echo "<td class='centrar'>"."<a href='eliminar_usuario.php?id=".$Sql['id']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
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