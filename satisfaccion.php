<html lang="en">

<?php 

	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];

?>

<head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Satisfacción</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">

</head>

<body>
    <div class="project-site-wrapper">   
        <div class="wrapper">
            
					<div class="table-wrapper2">
                    <div class="table-title">
                        <span><i class="fas fa-chart-line"></i> Satisfacción</span>
                    </div>

                    <table class="table1">
                        <thead>
                            <tr>
                                <th>CLIENTES</th>
								<?php
									$reqs = get_reqHasEffort($project);
									$reqAux = $reqs;
									$nReqs = $reqs->num_rows;
									while ($filaR = $reqs -> fetch_array()) {
										echo "<th>$filaR[1]</th>";
										$array[$filaR[1]] = 0;
									}
									
									//echo sizeof($array);
								?>
								<th>IMPORTANCIA</th>
                            </tr>
                        </thead>

						<tbody>
                            <?php
								$clients = get_clientsFromProject($project);
								while ($filaC = $clients -> fetch_array()) {
									$reqs = get_reqHasEffort($project);
									echo "<tr><td>$filaC[1] $filaC[2]</td>";
									while ($filaR = $reqs -> fetch_array()) {
										$valor = obtenerValor($project, $filaC[0], $filaR[0]);
										$tam = $valor->num_rows;
										//echo $tam;
										if($tam==0){
											echo "<td>0</td>";
										}else{
											$v = $valor -> fetch_array();
											echo "<td>$v[0]</td>";
										}
									}
									
									echo "<td>$filaC[3]</td>";
											
									echo "</tr>";
								}
							
								$satis = getSatisfaction($project);
								echo '<tr><th>EF.</th>';
								if($satis != null){
									foreach ($satis as &$valor) {
									echo "<th>$valor</th>";
									}
								}else{
									for($i = 0; $i < $nReqs; $i++){
										echo "<th></th>";
									}
								}
								echo"<th></th></tr>";
							?>
							
                        </tbody>
                    </table>
					<a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">VOLVER</a>
                </div>
        </div>
    </div>
</body>

</html>