<?php session_start(); ?>
<html lang="en">
	<?php 
	include 'Funciones/list-functions.php';
	
	$cli = $_GET['client'];
	
	$infoC = get_ClientInfo($cli);
	$info = $infoC -> fetch_array();
	
	$projects = get_ReqFromClient($cli);
	
	?>

        <head>
                <meta charset="utf-8">
            
                <title>Proyecto NRP | <?php echo"$info[1] $info[2]";?></title>
                <meta name="description" content="Proyecto NPR">
            
                <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
                    crossorigin="anonymous">
            
                <link rel="stylesheet" href="main.css">
            
            </head>
            <body>
                    <div class="wrapper">
                        <div class="cliente-requisito-wrapper">
                            <div class="nombre-proyecto">
                                <h1><?php echo $info[1];?></h1>
                                <span># <?php echo $info[0];?></span>
                            </div>
                            <div class="datos-cliente">
                                <div class="dato">
                                 <span>Apellidos</span><span class="valores-dato"><?php echo $info[2];?></span>
                                </div>
                                <div class="dato">
                                 <span>Email</span><span class="valores-dato"><?php echo $info[3];?></span>
                                 </div>
                                 <div class="last-dato">
                                    <span>Teléfono</span><span class="valores-dato"><?php echo $info[4];?></span>
                                </div>
                            </div>
                            <div class="listas listas2">                                
                                <div class="table-wrapper3">
                                    <div class="table-title">
                                        <span><i class="fa fa-project-diagram"></i> Requisitos</span>                                        
                                    </div>
                
                                    <table class="table1">
                                        <thead>
                                            <tr>
                                                <th>PROYECTO</th>
                                                <th>REQUISITO</th>
												<th>VALOR</th>
                                            </tr>
                                        </thead>
                
                                        <tbody>
										<?php
						
											while ($filaR = $projects -> fetch_array()) {
												echo"
												<tr>
													<td>$filaR[0]</td>
													<td>$filaR[1]</td>
													<td>$filaR[2]</td>
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