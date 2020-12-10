<!doctype html>



<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Nuevo Cliente</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="main.css">

  </head>
  
  <body>

    <div class="wrapper">
      <div>
	<div class="nombre-seccion">
	  <span><i class="fa fa-user-tie"></i> Nuevo Cliente</span>
	</div>

	<form method="post" name="crear">
	  <div class="field">
	    <span>Nombre de usuario</span>
	    <input name="username" type="text" value="" required>
	  </div>
	  
	  <div class="field">
	    <span>Nombre</span>
	    <input name="nombre" type="text" value="" required>
	  </div>
	  
	  <div class="field">
	    <span>Apellidos</span>
	    <input name="apellidos" type="text" value="" required>
	  </div> 
	  <div class="field">
	    <span>Correo electrónico</span>
	    <input name="correo" type="email" value="" required>
	  </div>
	  <div class="field">
	    <span>Número de teléfono</span>
	    <input name="telefono" type="tel" value="" required>
	  </div>
	  <div class="field">
	    <span>Contraseña</span>
	    <input name="pass" type="password" value="" required>
	  </div>

	  <div class="submit">
			<a class="cancel" href="./index2.php">CANCELAR</a>
			<input type="submit" value="AÑADIR" name="crear"/>		
	  </div>
	</form>
      </div>
    </div>
	<?php
	include 'Funciones/list-functions.php';
	
	if (isset($_POST['crear'])) 
          {
				$infoR = insertClient($_POST['username'], $_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['telefono'], $_POST['pass']);
				echo"<script>location='index2.php'</script>";
		  }

	?>
    
    <script src="main.js"></script>
  </body>

</html>
