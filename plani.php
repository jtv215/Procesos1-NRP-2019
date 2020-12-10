<html lang="en">

<?php 

	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];

	$infoP = get_projectInfo($project);
	$fila = mysqli_fetch_array($infoP);
	
	if (isset($_POST['cambiarTODO'])) {
          	$yes = $_POST['sel'];
          	$no = $_POST['des'];
          	if($yes != null){
          		$miArray = unserialize(stripslashes($yes));
          		if($miArray != null){
          			foreach ($miArray as $clave) {
          				set_todo($project, $clave, 1);
          			}
          		}
          	}

          	if($no != null){
          		$miArray2 = unserialize(stripslashes($no));
          		if($miArray2 != null){
          			foreach ($miArray2 as $clave) {
          				set_todo($project, $clave, 1);
          			}
          		}
          	}
		  }
?>

<head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Planificación</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">

</head>

<body>
    <div class="project-site-wrapper">   
        <div class="wrapper">
			<div class="planning-wrapper">
				<div class="planning-esf">
					<span>Esfuerzo disp.: <span><?php echo $fila[3]; ?></span></span>
				</div>
				<div class="table-wrapper2">
					<div class="table-title">
						<span><i class="fas fa-clock"></i> Planificación</span> <div class="auto-plan"><i class="fas fa-robot"></i></div>
					</div>
					
							<?php
							$i = 0;
							$esf = 0;
							$esfProyect = 20; // CAMBIAR

							$enviarDes = null;
							$enviarSel = null;

							// Array ID-Satisfacción
							$satis = getSatisfaction($project);
							if($satis == null) {
								echo "Introduce requisitos y valoralos.";
							}else{
							arsort($satis);

							// Array ID-Esfuerzo
							$req_esf;
							foreach ($satis as $clave => $valor) {
								$req_esf[$clave] = get_effortFromReq($project, $clave)[0];
							}

							$esfN = 0;
							$seleccionados = null;
							$descartados = null;
							foreach ($req_esf as $clave => $valor) {

								$esfN = $esf + $valor;
								if($esfN <= $esfProyect){
									$seleccionados[$clave] = $valor;
									$esf = $esfN;
								}else{
									$descartados[$clave] = $valor;
								}
							}

							if ($seleccionados != null){
								echo '<table class="table1">
										<thead>
											<tr>
												<th>REQUISITO</th>
												<th>SATISFACCIÓN</th>
												<th>ESFUERZO</th>
												<th>PRODUCTIVIDAD</th>
											</tr>
										</thead>
										
										<tbody>';
								$i = 0;
								foreach ($seleccionados as $clave => $valor) {
									$enviarSel[$i++] = $clave;
									$nombre = get_reqName($clave)[0];
									$prod = $satis[$clave]/$req_esf[$clave];
									echo 
									"<tr class='plan-row'>
									<td>$nombre</td><td>$satis[$clave]</td><td>$req_esf[$clave]</td><td>$prod</td></tr>";
								}

								echo"</tbody>
									</table>";
									echo "<br>";
							}else{
								echo "Aumenta el esfuerzo disponible, no se puede realizar ningún requisito.";
							}
							
							
							if ($descartados!= null){
								echo "Descartados != null";
								$i = 0;
								foreach ($descartados as $clave => $valor) {
									$enviarDes[$i++] = $clave;
									$nombre = get_reqName($clave)[0];
									$prod = $satis[$clave]/$req_esf[$clave];
									echo "El requisito $nombre con satisfacción = $satis[$clave], esfuerzo = $req_esf[$clave] y productividad $prod ha sido descartado";
								}
							}else{
								echo "No se ha descartado ningún requisito.";
							}
						}
							?>
				<div class="submit">	
				<a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">VOLVER</a>
				<form method="post" name="mihidden">
					<input type="hidden" name="sel" value='<?php echo serialize($enviarSel);?>'>
					<input type="hidden" name="des" value='<?php echo serialize($enviarDes);?>'>
					<input type="submit" value="GUARDAR"/ name="cambiarTODO">
				</form>
			</div>
			
			</div>
			</div>
        </div>
	</div>
	<script src="main.js"></script>
</body>

</html>