<html lang="en">

<?php 

	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];
	$infoP = get_projectInfo($project);
	$info = mysqli_fetch_array($infoP);

	if (isset($_POST['cambiarTODO'])) {
		$yes = $_POST['sel'];
		$no = $_POST['des'];
		if($yes != null){
			$miArray = json_decode($yes);//unserialize(stripslashes($yes));
			if($miArray != null){
				foreach ($miArray as $clave) {
					//echo"<script type='text/javascript'>console.log('pepito'+$clave);</script>";
					set_todo($project, $clave, 1);
				}
			}
		}

		if($no != null){
			$miArray2 = json_decode($no);//unserialize(stripslashes($no));
			if($miArray2 != null){
				foreach ($miArray2 as $clave) {
					//echo"<script type='text/javascript'>console.log($clave);</script>";
					set_todo($project, $clave, 0);
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
					<span>Esfuerzo disp.<span id="esf-indicator"><?php echo $info[3]; ?></span></span>
				</div>
				<div class="table-wrapper2">
					<div class="table-title">
						<span><i class="fas fa-clock"></i> Planificación</span> <div class="auto-plan" onclick="autoPlan()"><i class="fas fa-robot"></i></div>
					</div>
					
					<table class="plan table1">
						<thead>
							<tr>
								<th style="text-align:center;font-size:18px;"><i class="fas fa-arrows-alt-v"></i></th>
								<th>ID</th>
								<th>REQUISITO</th>
								<th>SATISFACCIÓN</th>
								<th>ESFUERZO</th>
								<th>PRODUCTIVIDAD</th>
								<th>IN/EXCLUIR</th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							$i = 0;
							$esf = 0;
							$esfProyect = $info[3]; // CAMBIAR
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
								$enviarSel = null;
								$enviarDes = null;
								$contadorS = 0;
								$contadorD = 0;
								foreach ($req_esf as $clave => $valor) {
									$esfN = $esf + $valor;
									if($esfN <= $esfProyect){
										$seleccionados[$clave] = $valor;
										$esf = $esfN;
										$enviarSel[$contadorS] = $clave;
										$contadorS++;
									} else {
										$enviarDes[$contadorD] = $clave;
										$contadorD++;
									}
								}
							}
							//==================================================

							$class = "class='plan-row req-excluido'";
							$reqs = get_requerimentsFromProject($project);

							if ($reqs == null && $satis) {
								echo "Introduce requisitos y valoralos.";
							} else {
								while ($filaR = $reqs -> fetch_array()) {
									$check = "<i class='fas fa-check-circle' onclick='manualToggleInc($i)'></i>";
									$reqID = $filaR[0];
									$prodReq = number_format($satis[$reqID] / $filaR[2], 2);
									
									$esf = $esf + $filaR[2];
									
									echo 
									"<tr $class><td><div onclick='moveUp($i)'><i class='far fa-arrow-alt-circle-up'></i></div>
									<div onclick='moveDown($i)'><i class='far fa-arrow-alt-circle-down'></i></div></td>
									<td>$filaR[0]</td><td>$filaR[1]</td><td>$satis[$reqID]</td><td>$filaR[2]</td><td>$prodReq</td>
									<td class='plan-check'>$check</td></tr>";

									$i++;
								}
							}
							?>
					</tbody>
					
					
				</table>
					<form class="options" method="post">
						<a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">VOLVER</a>
						<input id="selR" type="hidden" name="sel" value='<?php echo serialize($enviarSel);?>'>
						<input id="desR" type="hidden" name="des" value='<?php echo serialize($enviarDes);?>'>
						<input class="confirm" type="submit" value="GUARDAR" name="cambiarTODO">
					</form>
				</div>
			</div>
        </div>
	</div>

	<script type='text/javascript'>
		<?php
		$js_seleccionados = json_encode($enviarSel);
		$js_deseleccionados = json_encode($enviarDes);
		//echo "console.log($js_seleccionados);";
		//echo "console.log($js_deseleccionados);";
		echo "var seleccionados = ". $js_seleccionados . ";\n";
		echo "var deseleccionados = ". $js_deseleccionados . ";\n";
		?>
	</script>

	<script src="main.js"></script>
</body>

</html>