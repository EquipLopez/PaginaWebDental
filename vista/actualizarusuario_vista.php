<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>USUARIOS</h2>
					</div>
          <!--se crea un nuevo formulario para modificar los datos del usuario-->
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR USUARIOS</h2><br/>
                        <input type="hidden" name="id" value="<?php echo $user['id'];?>">
                        <!-- en esta caja de texto se muestra el usuario del seleccionado-->
                        <input type="text" name="usuario" placeholder="Usuario" value="<?php echo $user['usuario'];?>" autofocus/>
                        <!-- en este select se muestra el nombre del usuario  seleccionado-->
                        <input type="text" name="nombres" placeholder="Nombres" value="<?php echo $user['nombres'];?>"/>
                        <!-- en este select se muestra el apellido del usuario  seleccionado-->
                        <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $user['apellidos'];?>"/>
                        <!-- en este select se muestra el roll del usuario seleccionado-->
                        <select name="roll">
                            <option value="admin">Admin</option>
                            <option value="Limitado">Limitado</option>
                        </select>
                         <!--este un boton el cual envia los nuevos datos actualizados del formulario para ser guardados-->
                        <input type="submit" value="Editar" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
                     </form>
                    <a class="btn-regresar" href="usuarios.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>
</html>