<?php session_start(); ?>
<html lang="en">

<?php 
	include 'Funciones/list-functions.php';
	
	$req = $_GET['requirement'];
	
	$infoR = get_reqInfo($req);
	$info = $infoR -> fetch_array();
?>

  <head>
    <meta charset="utf-8">

    <title>Proyecto NRP | <?php echo"$info[1]";?></title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="main.css">

  </head>
  <body>
        <div class="wrapper">
            <div class="cliente-requisito-wrapper">
                <div class="nombre-proyecto">
                    <h1><?php echo $info[1];?></h1>
                    <span>ID: #<?php echo $info[0];?></span>
                </div>
                <div class="descripcion-proyecto">                   
                     <p><?php echo $info[2];?></p>                                 
                </div>
                <div class="listas listas2">                                
                    <div class="table-wrapper3">
                        <div class="table-title">
                            <span><i class="fa fa-file-alt"></i> Requisitos</span>                                        
                        </div>
    
                        <table class="table1">
                            <thead>
                                <tr>
                                    <th>PROYECTO</th>
                                    <th>CLIENTE</th>
									<th>VALOR</th>
                                </tr>
                            </thead>
    
                            <tbody>
							<?php
							$req = get_reqInProjectsAndImportance($req);
						
							while ($fila = $req -> fetch_array()) {
								echo"<tr>
									<td>$fila[0]</td>
									<td>$fila[1]</td>
									<td>$fila[2]</td>
								</tr>";
							}
							?>
							</tbody>
                        </table>
                    </div>
					<a class="cancel" href=<?php echo $_SESSION["previousPage"];?>>VOLVER</a>
                </div>
            </div>
    
        </div>
    </body>
</html>