<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>ESPECIALIDADES</h2>
					</div>
          <!--se crea un nuevo formulario para modificar los datos de las especialidades-->
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <h2>EDITAR ESPECIALIDADES</h2><br/>
                        <input type="hidden" name="id" value="<?php echo $especialidad['idespecialidad'];?>">
                        <!-- en esta caja de texto se muestra el nombre de la especialida seleccionada-->
                        <input type="text" name="nombre" placeholder="Especialdades:" value="<?php echo $especialidad['espNombre'];?>" autofocus/>
                         <!--este un boton el cual envia los nuevos datos actualizados del formulario para ser guardados-->
                        <input type="submit" value="Editar Especialidad" />
                        <?php  if(!empty($errores)): ?>
                          <ul>
                              <?php echo $errores; ?>
                          </ul>
                        <?php  endif; ?>
                     </form>
                    <a class="btn-regresar" href="especialidades.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>