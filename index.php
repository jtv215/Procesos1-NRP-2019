<?php
	include 'Funciones/list-functions.php';
?>

<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Proyecto NRP | Selecciona Gestor</title>
		<meta name="description" content="Proyecto NRP">

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
		<link rel="stylesheet" href="main.css">

	</head>
	<body>
		<div id="cover">
			<h1 id="cover-title">PROYECTO NRP</h1>
		</div>
	
		<div class="project-site-wrapper">
			<div class="left-nav">
				<div class="left-nav-top"></div>
			</div>

			<div class="wrapper">
				<form class="login-form" action="./index2.php" method="POST"> 
					<div class="log-icon">
						<i class="fas fa-user"></i>
					</div>
					<div class="login-field field">
						<span>Selecciona un Gestor</span>
						<select name="jefe" required>
							<?php
							$jefes = getJefes();
				
							while ($fila = $jefes -> fetch_array()) {
							echo"
								<option value=$fila[0]>$fila[1] $fila[2]</option>
							";
							}
							?>
						</select>
					</div>
					<div class="field submit2" > 
						<input type="submit" value="ACEPTAR">
					</div>
				</form>
			</div>
			<div class="left-nav">
				<div class="left-nav-top"></div>
			</div>
		</div>

		<script src="main.js"></script>
	</body>
</html>
