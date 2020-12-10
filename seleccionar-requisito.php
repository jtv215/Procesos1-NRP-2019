<html lang="en">

<?php 

	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];
	
    $client = $_GET['client'];
    
    $req = get_requerimentsFromProjectAndClientWithNoLove($project, $client);
?>

<head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Seleccionar requisito</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">

    <script LANGUAGE="JavaScript"> 	
		function next(project, client, req){
			location.href ="asignar-valor.php?project="+project+"&client="+client+"&req="+req; 
		}
	</script>
</head>

<body>
    <div class="project-site-wrapper">   
        <div class="wrapper">
            
             <div class="table-wrapper2">
                <div class="table-title">
                    <span><i class="fa fa-file-alt"></i> Selecciona un requisito</span>
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
                            if($req){
                                while ($filaR = $req -> fetch_array()) {
                                    echo"<tr onclick='next($project, $client, $filaR[0])'>
                                    <td>$filaR[0]</td>
                                    <td>$filaR[1]</td>
                                    </tr>";
                                }
                            } else {
                                echo"<tr><td>NO HAY REQUISITOS SIN VALORAR POR ESTE CLIENTE</td><td></td></tr>";
                            }
                            ?>
                    </tbody>
                </table>
                <a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">CANCELAR</a>
            </div>
        </div>
    </div>
</body>

</html>