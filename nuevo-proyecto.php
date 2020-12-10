<?php include 'Funciones/list-functions.php'; 

if (isset($_POST['crearProyecto'])) 
{
	insertProyecto($_POST['nombre'], $_POST['descripcion'], $_POST['esfuerzo'], $_POST['jefeID']);
}

?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Nuevo Proyecto</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="main.css">

  </head>

  <body>

    <div class="wrapper">
      <div>
				<div class="nombre-seccion">
					<span><i class="fa fa-project-diagram"></i> Nuevo Proyecto</span>
				</div>

				<form method="post">
					<div class="field">
						<span>Nombre</span>
						<input name="nombre" type="text" value="" required>
					</div>

					<div class="field">
						<span>Descripción</span>
						<textarea rows="4" cols="50" class="description" name="descripcion"></textarea>
					</div>

					<div class="field">
						<span>Esfuerzo Disponible</span>
						<input type="number" name="esfuerzo" min="0" value="0" required>
					</div>

					<div class="field">
						<span>Jefe de Proyecto</span>
						<select name="jefeID" style="width:98.5%;" required>
							<?php
							$jefes = getJefes();
				
							while ($fila = $jefes -> fetch_array()) {
								echo"<option value='$fila[0]'>$fila[1] $fila[2]</option>";
							}
							?>
						</select>
					</div>

	  			<div class="submit">
						<a class="cancel" href="./index2.php">CANCELAR</a>
	    			<input type="submit" value="AÑADIR" name="crearProyecto"/>
	  			</div>
				</form>
      </div>
    </div>
    <script src="main.js"></script>
  </body>

</html>
