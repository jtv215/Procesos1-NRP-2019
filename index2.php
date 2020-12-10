<?php
	session_start();
	include 'Funciones/list-functions.php';
	
	if (isset($_POST["jefe"])) {
		$jefe = $_POST["jefe"];
		$_SESSION["jefe"] = $jefe;
	}
	$jefe = $_SESSION["jefe"];
	$_SESSION["previousPage"] = "index2.php";
?>

<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Proyecto NRP | Inicio</title>
		<meta name="description" content="Proyecto NRP">

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
		<link rel="stylesheet" href="main.css">

	</head>
	<script LANGUAGE="JavaScript"> 
		function goToProject(id){
			location.href ="proyecto.php?project="+id; 
		}
		
		function goToClient(id){
			location.href ="cliente.php?client="+id; 
		}
		
		function goToRequirement(id){
			location.href ="requisito.php?requirement="+id; 
		}
	</script>

	<body>
		<div class="project-site-wrapper">

			<div class="left-nav">
				<div class="left-nav-top">
					<span>Vista principal</span>
							
						<a href="./nuevo-proyecto.php">
							<i class="fa fa-project-diagram"></i> Crear proyecto
						</a>
									
						<a href="./nuevo-cliente.php">
							<i class="fa fa-user-tie"></i> Crear cliente
						</a>
											
						<a href="./nuevo-requisito.php">
							<i class="fa fa-file-alt"></i> Crear requisito
						</a>
				</div>
				<div>
					<a class="back-link" href="./index.php">
							<i class="fas fa-chevron-circle-left"></i> Cerrar sesión
					</a>
				</div>
		</div>

		<div class="wrapper">
	
	<div class="table-wrapper">
	  <div class="table-title">
	    <span><i class="fa fa-project-diagram"></i> Proyectos</span>
	    <a href="./nuevo-proyecto.php"><i class="fa fa-plus"></i></a>
	  </div>
	  
	  <table class="table1">
	    <thead>
	      <tr>
					<th>ID</th>
					<th>NOMBRE</th>
	      </tr>
	    </thead>
	    
	    <tbody>
			<?php
				$proyectos = get_projects($jefe);	
				while ($fila = $proyectos -> fetch_array()) {
				echo"<tr onclick='goToProject($fila[0])'>
					<td>$fila[0]</td>
					<td>$fila[1]</td>
					</tr>";
				}
			?>
			</tbody>
		</table>
	</div>

	<div class="table-wrapper">
	  <div class="table-title">
	    <span><i class="fa fa-user-tie"></i> Clientes</span>
	    <a href="./nuevo-cliente.php"><i class="fa fa-plus"></i></a>
	  </div>
	  
	  <table class="table1">
	    <thead>
	      <tr>
		<th>ID</th>
		<th>NOMBRE</th>
	      </tr>
	    </thead>
	    
	    <tbody>
	      <?php
				$clients = get_clients();
				
				while ($fila = $clients -> fetch_array()) {
					echo"<tr onclick='goToClient($fila[0])'>
						<td>$fila[0]</td>
						<td>$fila[1] $fila[2]</td>
						</tr>";
				}
				?>
				</tbody>
			</table>
		</div>

	<div class="table-wrapper">
	  <div class="table-title">
	    <span><i class="fa fa-file-alt"></i> Requisitos</span>
	    <a href="./nuevo-requisito.php"><i class="fa fa-plus"></i></a>
	  </div>
	  
	  <table class="table1">
	    <thead>
	      <tr>
		<th>ID</th>
		<th>NOMBRE</th>
	      </tr>
	    </thead>
	    
	    <tbody>
	       <?php
				$req = get_requeriments();
				
				while ($fila = $req -> fetch_array()) {
					echo"<tr onclick='goToRequirement($fila[0])'>
						<td>$fila[0]</td>
						<td>$fila[1]</td>
						</tr>";
				}
				?>
				</tbody>
				</table>
			</div>
		</div>
			</div>
		<script src="main.js"></script>
	</body>
</html>
