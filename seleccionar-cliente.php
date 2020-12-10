<html lang="en">

<?php 

	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];
	
	$clients = get_clientsFromProject($project);
?>

<head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Seleccionar cliente</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    
    <script LANGUAGE="JavaScript"> 	
		function next(project, client){
			location.href ="seleccionar-requisito.php?project="+project+"&client="+client; 
		}
	</script>
</head>

<body>
    <div class="project-site-wrapper">   
        <div class="wrapper">
            
            


            <div class="table-wrapper2">
                <div class="table-title">
                    <span><i class="fa fa-user-tie"></i> Selecciona un cliente</span>
                </div>
                
                <table class="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>IMPORTANCIA</th>
                        </tr>
                    </thead>
                                    
                    <tbody>
                    <?php

                    while ($filaC = $clients -> fetch_array()) {
                        echo"<tr onclick='next($project, $filaC[0])'>
                        <td>$filaC[0]</td>
                        <td>$filaC[1] $filaC[2]</td>
                        <td>$filaC[3]</td>
                        </tr>";
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