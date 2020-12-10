<html lang="en">

<?php 

	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];

	$infoP = get_projectInfo($project);
	$fila = mysqli_fetch_array($infoP);
	
?>

<head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Planificación Actual</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">

</head>

<body>
    <div class="project-site-wrapper">   
        <div class="wrapper">
			<div>
				<div class="table-wrapper2">
					<div class="table-title">
						<span><i class="far fa-calendar-alt"></i> Planificación Actual</span>
					</div>
					
							<?php
							$i = 0;
							
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
							$seleccionados = get_reqInProjecTODO($project);
							$descartados = get_reqInProjecNotTODO($project);
							$nSel = $seleccionados->num_rows;
							$nDes = $descartados->num_rows;
							if ($nSel != 0){
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
								while ($filaC = $seleccionados -> fetch_array()) {
									$id = $filaC[0];
									$nombre = get_reqName($id)[0];
									$prod = number_format($satis[$id]/$req_esf[$id], 2);
									echo 
									"<tr class='plan-row'>
									<td>$nombre</td><td>$satis[$id]</td><td>$req_esf[$id]</td><td>$prod</td></tr>";
				                }

								echo"</tbody>
									</table>";
									echo "<br>";
							}else{
								echo "No hay ningún requisito seleccionado.";
							}
							
							
							if ($nDes!= 0){
								$i = 0;
								echo "<span style='margin-top:16px;'></span><ul style='width:92%;margin:auto;font-size:14px;text-align:justify;'>";
								while ($filaC = $descartados -> fetch_array()) {
									$id = $filaC[0];
									$nombre = get_reqName($id)[0];
									$prod = number_format($satis[$id]/$req_esf[$id], 2);
									echo "<li>El requisito $nombre con satisfacción = $satis[$id], esfuerzo = $req_esf[$id] y productividad $prod ha sido descartado.</li>";
				                }
				                echo "</ul>";
							}else{
								//echo "No se ha descartado ningún requisito.";
							}
						}
							?>
				<div class="submit">	
				<a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">VOLVER</a>
			</div>
			
			</div>
			</div>
        </div>
	</div>
	<script src="main.js"></script>
</body>

</html>