<html lang="en">

<?php 

	include 'Funciones/list-functions.php';
	
	$project = $_GET['project'];
	
    $client = $_GET['client'];
    
    $req = $_GET['req'];
?>

<head>
    <meta charset="utf-8">

    <title>Proyecto NRP | Asignar valor</title>
    <meta name="description" content="Proyecto NRP">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">

</head>

<body>
    <div class="project-site-wrapper">   
        <div class="wrapper">

     <div id="nuevo-requisito">

<div class="nombre-seccion">
  <span><i class="fa fa-coins"></i> Asignar valor</span>
</div>

<form method="post">
  <div class="field">
    <span>Nombre</span>
    <input name="nombre" type="text" value="<?php
      $reqs = get_reqInfo($req);

      while ($fila = $reqs -> fetch_array()) {
        echo"$fila[1]";
      }
      ?>" disabled>
  </div>

    <div class="field">
        <span>Descripción</span>
        <textarea rows="4" cols="50" class="description" name="descripcion" disabled>
<?php
$reqs = get_reqInfo($req);
while ($fila = $reqs -> fetch_array()) {
    echo"$fila[2]";
}
?>
        </textarea>
    </div>

  <div class="field">
    <span>Cliente</span>
    <select name="cliente" disabled>
      <?php
      $clients = get_clientInfo($client);

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
    <input type="number" name="valor" min="1" max="5" value="1">
  </div>

  <div class="submit">
    <a class="cancel" href="proyecto.php?project=<?php echo $project; ?>">CANCELAR</a>
    <input type="submit" value="ACEPTAR"/ name="anadir-valor">
<?php
if (isset($_POST['anadir-valor'])) 
    {
        $infoR = insertValor($project, $client, $req, $_POST['valor']);
        echo"<script>location='proyecto.php?project=$project'</script>";
    }
?>
  </div>
</form>
</div>

</div>            

<script src="main.js"></script>

</body>
</html>