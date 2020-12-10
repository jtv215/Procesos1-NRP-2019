<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Nuevo Requisito</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="main.css">

  </head>

  <body>

    <div class="wrapper">
      <div>
	<div class="nombre-seccion">
	  <span><i class="fa fa-file-alt"></i> Nuevo Requisito</span>
	</div>

	<form method="post" name="crearRequisito">
	  <div class="field">
	    <span>Nombre</span>
	    <input name="nombre" type="text" value="" required>
	  </div>

	  <div class="field">
	    <span>Descripción</span>
	    <textarea rows="4" cols="50" class="description" name="descripcion"></textarea>
	  </div>

	  <div class="submit">
			<a class="cancel" href="./index2.php">CANCELAR</a>
	    <input type="submit" value="AÑADIR"/ name="crearRequisito">
	  </div>
	</form>
      </div>
    </div>
	<?php
	include 'Funciones/list-functions.php';
	
	if (isset($_POST['crearRequisito'])) 
          {
				$infoR = insertRequisitos($_POST['nombre'], $_POST['descripcion']);
				echo"<script>location='index2.php'</script>";
		  }

	?>
    
    <script src="main.js"></script>
  </body>

</html>
