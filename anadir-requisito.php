<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Añadir Requisito</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="main.css">

  </head>
  <?php
	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];
	
	$infoP = get_projectInfo($project);
	$p = $infoP -> fetch_array();
	
	if (isset($_POST['anadir'])) 
  {
    $infoR = insertOldReqAndVal($project, $_POST['cliente'], $_POST['requisito'], $_POST['valor'], $_POST['esfuerzo']);
    //$infoR = insertEsfuerzo($project, $_POST['requisito'], $_POST['esfuerzo']);
    echo"<script>location='proyecto.php?project=$project'</script>";
  }
		
	if (isset($_POST['crear'])) 
  {
    $infoR = insertNewReqAndVal($project, $_POST['cliente'], $_POST['nombre'], $_POST['descripcion'], $_POST['valor'], $_POST['esfuerzo']);
    //$infoR = insertEsfuerzo($project, $_POST['requisito'], $_POST['esfuerzo']);
    echo"<script>location='proyecto.php?project=$project'</script>";
  }
	
?>

  <body>

    <div class="project-site-wrapper">

      <div class="left-nav">
        <div class="left-nav-top">
          <span>Añadir cliente</span>
          
          <a onclick="showDiv(1, 0)">
            <i class="fas fa-plus-circle"></i> Crear nuevo requisito
          </a>
              
          <a onclick="showDiv(0, 1)">
            <i class="fas fa-folder-open"></i> Añadir requisito existente
          </a>
          
        </div>
        <div>
          <a class="back-link" href="proyecto.php?project=<?php echo $project; ?>">
            <i class="fas fa-chevron-circle-left"></i> Volver atrás
          </a>
        </div>
      </div>

      <div class="wrapper">

        <!------------------------------->
        <!-- AÑADIR UN REQUISITO NUEVO -->
        <!------------------------------->
        <div id="nuevo-requisito" class="endiv">

          <div class="nombre-seccion">
            <span><i class="fa fa-file-alt"></i> Nuevo Requisito - </span><span><?php echo $p[1] ?></span>
          </div>

          <form method="post">
            <div class="field">
              <span>Nombre</span>
              <input name="nombre" type="text" value="" required>
            </div>
      
            <div class="field">
              <span>Descripción</span>
              <textarea rows="4" cols="50" class="description" name="descripcion"></textarea>
            </div>

            <div class="field">
              <span>Cliente</span>
              <select name="cliente" required>
                <?php
                $clients = get_clientsFromProject($project);
      
                while ($fila = $clients -> fetch_array()) {
                  echo"
                    <option value=$fila[0]>$fila[1]</option>
                  ";
                }
                ?>
              </select>
            </div>

            <div class="field">
              <span>Valor</span>
              <input type="number" name="valor" min="0" max="5" value="1">
            </div>
    
            <div class="field">
              <span>Esfuerzo</span>
              <input type="number" name="esfuerzo" min="1" max="10" value="1" required>
            </div>
      
            <div class="submit">
              <a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">CANCELAR</a>
              <input type="submit" value="CREAR"/ name="crear">
            </div>
          </form>
        </div>

        <!-------------------------------------->
        <!-- AÑADIR UN REQUISITO YA EXISTENTE -->
        <!-------------------------------------->
        <div id="anadir-requisito" class="endiv">

          <div class="nombre-seccion">
            <span><i class="fa fa-file-alt"></i> Añadir Requisito - </span><span><?php echo $p[1] ?></span>
          </div>

          <form method="post">
            <div class="field">
              <span>Requisito</span>
              <select name="requisito" required>
                <?php
                $req = get_reqHasNotEffort($project);

                while ($fila = $req -> fetch_array()) {
                  echo"
                    <option value=$fila[0]>$fila[1]</option>
                  ";
                }
                ?>
              </select>
            </div>

            <div class="field">
              <span>Cliente</span>
              <select name="cliente" required>
                <?php
                $clients = get_clientsFromProject($project);
      
                while ($fila = $clients -> fetch_array()) {
                  echo"
                    <option value=$fila[0]>$fila[1]</option>
                  ";
                }
                ?>
              </select>
            </div>

            <div class="field">
              <span>Valor</span>
              <input type="number" name="valor" min="0" max="5" value="1">
            </div>

            <div class="field">
              <span>Esfuerzo</span>
              <input type="number" name="esfuerzo" min="1" value="1" required>
            </div>
          
            <div class="submit">
              <a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">CANCELAR</a>
                <input type="submit" value="AÑADIR" name="anadir"/>
            </div>
          </form>
        </div>
      </div>            
    </div>
    <script src="main.js"></script>

  </body>
</html>