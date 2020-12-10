<?php session_start(); ?>
<html lang="en">

<?php 
	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];
	
	$infoP = get_projectInfo($project);
	$info = $infoP -> fetch_array();
	
	$clients = get_clientsFromProject($project);
    $req = get_requerimentsFromProject($project);
    
    $_SESSION["previousPage"] = "proyecto.php?project=$project";

    if (isset($_POST['cambiarEsfuerzo'])) {
        $esf = $_POST['esfuerzo'];
        set_effort($project, $esf);
    }
?>

<head>
    <meta charset="utf-8">

    <title>Proyecto NRP | <?php echo"$info[1]";?></title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">

	<script LANGUAGE="JavaScript"> 
		function goToClient(id){
			location.href ="cliente.php?client="+id; 
		}
		
		function goToRequeriment(id){
			location.href ="requisito.php?requirement="+id; 
		}
		
		function goToCreateRequeriment(id){
			location.href ="añadir-requisito.php?project="+id; 
		}
	</script>
	
</head>

<body>
    <div class="project-site-wrapper">

        <div class="left-nav">
            <div class="left-nav-top">
                <span>Vista de proyecto</span>

                <a class="satisfaction-button" href="planificacion.php?project=<?php echo $project; ?>" style="font-weight:bold">
                    <i class="fas fa-clock"></i> PLANIFICAR
                </a>            

                <a href="planificacionActual.php?project=<?php echo $project; ?>">
                    <i class="far fa-calendar-alt"></i> Mostrar planificación actual
                </a> 

                <a href="satisfaccion.php?project=<?php echo $project; ?>">
                    <i class="fas fa-chart-line"></i> Calcular satisfacción
                </a>

                <a href="anadir-cliente.php?project=<?php echo $project; ?>">
                    <i class="fa fa-user-tie"></i> Añadir clientes
                </a>
                
                <a href="anadir-requisito.php?project=<?php echo $project; ?>">
                    <i class="fa fa-file-alt"></i> Añadir requisitos
                </a>
                        
                <a href="seleccionar-cliente.php?project=<?php echo $project; ?>">
                    <i class="fa fa-coins"></i> Establecer valores de requisitos
                </a>
            </div>
            <div>
                <a class="back-link" href="./index2.php">
                    <i class="fas fa-chevron-circle-left"></i> Volver atrás
                </a>
            </div>
        </div>
            
        <div class="wrapper">
                
            <div class="proyecto-wrapper">
                <div class="nombre-proyecto">
                    <h1><?php echo $info[1];?></h1>
                    <span>ID: #<?php echo $info[0];?></span>
                </div>
                <div class="descripcion-proyecto">
                    <p><?php echo $info[2];?></p>
                </div>
                <div class="stats">
                    <form method="post" name="mihidden">
                        <div class="stats-title"><i class="fas fa-chart-area"></i> MÉTRICAS DEL PROYECTO</div>
                        <span>Esfuerzo disp.: 
                            <input type="text" name="esfuerzo" value='<?php 
                            if (isset($_POST['cambiarEsfuerzo'])){
                                echo $esf;
                            }else{
                                echo $info[3];
                            } 
                            ?>''>
                            <div class="submit3">    
                                <button type="submit" name="cambiarEsfuerzo"><i class="fas fa-edit"></i></button>
                            </div>
                        </span>

                        <span>Prod. del plan: 
                            <span>
                                <?php 
                                $reqs = get_reqInProjecTODO($project);
                                $satis = getSatisfaction($project);
                                $prodTotal = 0;
                                $satisTotal = 0;
                                if ($reqs != null){
                                    if ($satis != null) {
                                        while($fila = $reqs -> fetch_array()) {
                                            $prodTotal += $satis[$fila[0]] / $fila[2];
                                            $satisTotal += $satis[$fila[0]];
                                        }
                                        echo number_format($prodTotal, 2);
                                    } else {
                                        echo number_format($prodTotal, 2);
                                    }
                                } else {
                                    echo "NO HAY REQS. SELECCIONADOS";
                                }

                                
                                ?>
                            </span>
                        </span>
                        <span> Satis. del plan: 
                            <span><?php echo number_format($satisTotal, 2);?></span>
                    </form>
                </div>

                <div class="listas">
                    <div class="table-wrapper2">
                        <div class="table-title">
                            <span><i class="fa fa-user-tie"></i> Clientes</span>
                            <a href="anadir-cliente.php?project=<?php echo $project; ?>" onclick='goToCreateRequeriment(project)'><i class="fa fa-plus"></i></a>
                        </div>
                        
                        <table class="table1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>PESO</th>
                                    <th>CONTRI.</th>
                                    <th>COBERT.</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
            
                                $contri = 0;
                                $cobert = 0;
                                $valorCubierto = 0;
                                $valorTotal = 0;
                                $reqs = get_reqInProjecTODO($project);
                                while ($filaC = $clients -> fetch_array()) {
                                    while($fila = $reqs -> fetch_array()){
                                        if($filaC[0]==4)echo"<script type='text/javascript'>console.log('salim');</script>";
                                        $valor = obtenerValor($project, $filaC[0], $fila[0])->fetch_array();
                                        if($valor != null){
                                            if($filaC[0]==4)echo"<script type='text/javascript'>console.log($valor[0]);</script>";
                                            $contri += $filaC[3] * (int)$valor[0];
                                        }
                                    }
                                    if($satisTotal != 0){
                                        $contri = number_format($contri / $satisTotal, 2);
                                    } else {
                                        $contri = 0;
                                    }
                                    
                                    $reqs = get_reqInProjecTODO($project);
                                    while($fila = $reqs -> fetch_array()){
                                        $valor2 = obtenerValor($project, $filaC[0], $fila[0])->fetch_array();
                                        if($valor2 != null){
                                            $valorCubierto += (int)$valor2[0];
                                        }
                                    }
                                    while($filaR = $req -> fetch_array()){
                                        $valor = obtenerValor($project, $filaC[0], $filaR[0])->fetch_array();
                                        $valorTotal += (int)$valor[0];
                                    }
                                    if($valorTotal != 0){
                                        $cobert = number_format($valorCubierto / $valorTotal, 2);
                                    } else {
                                        $cobert = 0;
                                    }

                                    echo"<tr onclick='goToClient($filaC[0])'>
                                    <td>$filaC[0]</td>
                                    <td>$filaC[1] $filaC[2]</td>
                                    <td>$filaC[3]</td>
                                    <td>$contri</td>
                                    <td>$cobert</td>
                                    </tr>";
                                    
                                    $contri = 0;
                                    $cobert = 0;
                                    $valorCubierto = 0;
                                    $valorTotal = 0;
                                    $req = get_requerimentsFromProject($project);
                                    $reqs = get_reqInProjecTODO($project);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-wrapper2">
                        <div class="table-title">
                            <span><i class="fa fa-file-alt"></i> Requisitos</span>
                            <a href="anadir-requisito.php?project=<?php echo $project; ?>"><i class="fa fa-plus"></i></a>
                        </div>
                        
                        <table class="table1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>ESFUERZO</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                    while ($filaR = $req -> fetch_array()) {
                                        echo"<tr onclick='goToRequeriment($filaR[0])'>
                                        <td>$filaR[0]</td>
                                        <td>$filaR[1]</td>
                                        <td>$filaR[2]</td>
                                        </tr>";
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
				
            </div>
        </div>
    </div>
</body>

</html>