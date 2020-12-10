<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <title>Proyecto NRP | Añadir Cliente</title>
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
    $infoR = insertImportancia($project, $_POST['cliente'], $_POST['importancia']);
    echo"<script>location='proyecto.php?project=$project'</script>";
  }
    
  if (isset($_POST['crear'])) 
  {
    $infoR = insertClientAndImportancia($project, $_POST['nombreUsuario'], $_POST['nombre'], $_POST['apellidos'], $_POST['correo'],$_POST['telefono'], $_POST['contrasena'],$_POST['importancia1']);
    echo"<script>location='proyecto.php?project=$project'</script>";
  }
  
  ?> 
	  
<body>
  <div class="project-site-wrapper">

    <div class="left-nav">
      <div class="left-nav-top">
        <span>Añadir cliente</span>
        
        <a onclick="showDiv(1, 0)">
          <i class="fas fa-plus-circle"></i> Crear nuevo cliente
        </a>
            
        <a onclick="showDiv(0, 1)">
          <i class="fas fa-folder-open"></i> Añadir cliente existente
        </a>
        
      </div>
      <div>
        <a class="back-link" href="proyecto.php?project=<?php echo $project; ?>">
          <i class="fas fa-chevron-circle-left"></i> Volver atrás
        </a>
      </div>
    </div>

      <!----------------------------->
      <!-- AÑADIR UN CLIENTE NUEVO -->
      <!----------------------------->

    <div class="wrapper">
      <div id="nuevo-cliente" class="endiv">
        <div class="nombre-seccion">
          <span><i class="fa fa-file-alt"></i> Nuevo Cliente - </span><span><?php echo $p[1] ?></span>
        </div>
            
        <form method="post">
          <div class="field">
            <span>Nombre de usuario</span>
            <input name="nombreUsuario" type="text" value="" required>
          </div>
            
          <div class="field">
            <span>Nombre</span>
            <input name="nombre" type="text" value="" required>
          </div>

          <div class="field">
            <span>Apellidos</span>
            <input name="apellidos" type="text" value="" required>
          </div>

          <div class="field">
            <span>Correo electrónico</span>
            <input name="correo" type="text" value="" required>
          </div>

          <div class="field">
            <span>Numero de teléfono</span>
            <input name="telefono" type="text" value="" required>
          </div>

          <div class="field">
            <span>Contraseña</span>
            <input name="contrasena" type="text" value="" required>
          </div>
                  
          <div class="field">
            <span>Peso</span>
            <input type="number" name="importancia1" min="0" value="1">
          </div>
            
          <div class="submit">
            <a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">CANCELAR</a>
            <input type="submit" value="CREAR" name ="crear"/>
          </div>
        </form>
      </div>




      <div id="anadir-cliente" class="endiv">
        <div class="nombre-seccion">
          <span><i class="fa fa-file-alt"></i> Añadir Cliente - </span><span><?php echo $p[1] ?></span>
        </div>
        <form method="post">
          <div class="field">
            <span>Cliente</span>
            <select name="cliente">
            <?php
            $clients = get_clientsNotInProject($project);
    
            while ($fila = $clients -> fetch_array()) {
              echo"
                <option value=$fila[0]>$fila[1]</option>
              ";
            }
            ?>
            </select>
          </div>                     

          <div class="field">
            <span>Peso</span>
            <input type="number" name="importancia" min="0" value="1">
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