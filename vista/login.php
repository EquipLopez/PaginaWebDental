
<!DOCTYPE html>
<!-- es este docuemnto estan los componentes para la vista del formulario de login -->
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=decive-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <title>Iniciar - DentalCenter</title>

    <!-- mandamos a llamar la hoja de estilos en la carpeta donde la guardamos -->
    <link rel="stylesheet" href="css/login.css">
    <!-- se llama a la imagen en la carpeta donde este guardada-->
    <link rel="icon" type="image/x-svg" href="img/icono.svg">
</head>
<body>
  <!-- se crea la estructura del formulario -->
	<form class="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="login">
        <h2>DentalCenter</h2>
        <!-- agregamos una imagen-->
        <img src="img/icono.svg">
        <!-- agregamos una caja de texto para ingresar el nombre de usuario-->
        <input type="text" name="usuario"placeholder="Usuario" class="bordes" autofocus/>
        <!-- agregamos una caja de texto para ingresar la contreseña del usuario-->
        <input type="password" name="password" placeholder="Contraseña" class="bordes"/>
        <!-- agrego un boton para enviar los datos del usuario y poder ingresar a la pagina principal-->
        <input type="submit" value="Ingresar"></input>
        <?php  if(!empty($errores)): ?>
          <ul>
              <?php echo $errores; ?>
          </ul>
        <?php  endif; ?>
      </form>
</body>
</html>