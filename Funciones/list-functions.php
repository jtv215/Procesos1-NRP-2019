<?php 
include 'connection.php';
function get_projects($jefe)
{
  global $conn;
	$sql = "SELECT id, nombre FROM proyecto where id_jefe = $jefe order by id";
	$projects = $conn->query($sql);
	
	return $projects;
}

function get_clients()
{
  global $conn;
	$sql = "SELECT id, nombre, apellidos FROM cliente order by id";
	$clients = $conn->query($sql);
	
	return $clients;
}

function get_requeriments()
{
  global $conn;
	$sql = "SELECT id, nombre FROM requisito order by id";
	$req = $conn->query($sql);
	
	return $req;
}

function get_projectInfo($id)
{
  global $conn;
	$sql = "SELECT id, nombre, descripcion, esfuerzoMax FROM proyecto where id = $id";
	$projects = $conn->query($sql);
	
	return $projects;
}


function get_clientsFromProject($id)
{
  global $conn;
	$sql = "Select id, nombre, apellidos, peso from cliente, importancia where id_pro = $id and cliente.id = importancia.id_cli order by id";
	$clients = $conn->query($sql);
	
	return $clients;
}

function get_requerimentsFromProject($id)
{
  global $conn;
	$sql = "Select id, nombre, peso from requisito, esfuerzo where esfuerzo.id_req = requisito.id and id_pro = $id order by id";
	$req = $conn->query($sql);
	
	return $req;
}

function get_requerimentsFromProjectAndClientWithNoLove($id_pro, $id_cli)
{
	global $conn;
	$sql = 
		"SELECT id, nombre 
			FROM requisito
			WHERE id IN (
				SELECT DISTINCT id_req
				FROM esfuerzo
				WHERE id_pro = $id_pro
				AND id_req NOT IN (
					SELECT DISTINCT id_req 
					FROM valor 
					WHERE id_pro = $id_pro AND id_cli = $id_cli
				)
			)
			ORDER BY id";

	$req = $conn->query($sql);
	
	return $req;
}

function get_reqHasNotEffort($id)
{
  global $conn;
	$sql = "Select id, nombre from requisito where id not in (select id_req from esfuerzo where id_pro = $id)";
	$req = $conn->query($sql);
	
	return $req;
}

function get_reqHasEffort($id)
{
  global $conn;
	$sql = "Select id, nombre from requisito where id in (select id_req from esfuerzo where id_pro = $id)";
	$req = $conn->query($sql);
	
	return $req;
}


function get_reqInfo($id)
{
  global $conn;
	$sql = "SELECT id, nombre, descripcion FROM requisito where id = $id";
	$req = $conn->query($sql);
	
	return $req;
}

function get_reqInProjectsAndImportance($id)
{
  global $conn;
	$sql = "select proyecto.nombre, cliente.nombre, valor.valor from valor, proyecto, cliente where id_req = $id and valor.id_cli = cliente.id and valor.id_pro = proyecto.id";
	$req = $conn->query($sql);
	
	return $req;
}

function get_ClientInfo($id)
{
  global $conn;
	$sql = "SELECT id, nombre, apellidos, email, telefono FROM cliente where id = $id";
	$req = $conn->query($sql);
	
	return $req;
}

function get_ReqFromClient($id)
{
  global $conn;
	$sql = "select proyecto.nombre, requisito.nombre, valor.valor from valor, proyecto, requisito where id_cli = $id and valor.id_pro = proyecto.id and valor.id_req = requisito.id";
	$req = $conn->query($sql);
	
	return $req;
}


function insertClient($username, $nombre, $apellidos, $email, $telefono, $password)
{
  global $conn;
	$sql = "Insert into cliente (username, nombre, apellidos, email, telefono, password) values ('$username', '$nombre', '$apellidos', '$email', $telefono, '$password')";
	$req = $conn->query($sql);
	
	$clientID = "select id from cliente where username = '$username' and password = '$password'";
	
	return $clientID;
}

function insertProyecto($nombre, $descripcion, $esfuerzo, $jefeID)
{
  global $conn;
	$sql = "Insert into proyecto (id_jefe, nombre, descripcion, esfuerzoMax) values ('$jefeID', '$nombre', '$descripcion', '$esfuerzo')";
	$req = $conn->query($sql);
	
	//$requisitoID = "select id from proyecto where nombre = '$nameProyecto' and descripcion = '$descripcion'";
	
	return $req;
}


function insertRequisitos($nameRequisito, $descripcion)
{
  global $conn;
	$sql = "Insert into requisito (nombre, descripcion) values ('$nameRequisito', '$descripcion')";
	$req = $conn->query($sql);
	
	//$requisitoID = "select id from requisito where nombre = '$nameRequisito' and descripcion = '$descripcion'";
	
	return $req;
}

function insertValor($idPro, $idCli, $idReq, $valor)
{
  global $conn;
	$sql = "Insert into valor values ($idPro, $idReq, $idCli, $valor)";
	$req = $conn->query($sql);
	
	//$requisitoID = "select id from requisito where nombre = '$nameRequisito' and descripcion = '$descripcion'";
	
	return $req;
}

function insertEsfuerzo($idPro, $idReq, $peso)
{
  global $conn;
	$sql = "Insert into esfuerzo values ($idPro, $idReq, $peso, 0)";
	$req = $conn->query($sql);
		
	return $req;
}

function insertNewReqAndVal($idPro, $idCli, $nombre, $desc, $valor, $esf)
{
  global $conn;
	$sql = "Insert into requisito (nombre, descripcion) values ('$nombre', '$desc')";
	$ins = $conn->query($sql);
	
	$sqlReq = "select id from requisito where nombre = '$nombre' and descripcion = '$desc'";	
	$requisito = $conn->query($sqlReq);
	$info = $requisito -> fetch_array();
	$requisitoID = intval($info[0]);
	
	
	$sql2 = "Insert into valor values ($idPro, $requisitoID, $idCli, $valor)";
	$req = $conn->query($sql2);

	insertEsfuerzo($idPro, $requisitoID, $esf);
	
	return $req;
}


function insertOldReqAndVal($idPro, $idCli, $idReq, $valor, $esf)
{
  global $conn;
	
	$sql2 = "Insert into valor values ($idPro, $idReq, $idCli, $valor)";
	$req = $conn->query($sql2);

	insertEsfuerzo($idPro, $idReq, $esf);
	
	return $req;
}


function insertClientAndImportancia($idPro,$username, $nombre, $apellidos, $email, $telefono, $password, $importancia)
{
  global $conn;
	$sql = "Insert into cliente (username, nombre, apellidos, email, telefono, password) values ('$username', '$nombre', '$apellidos', '$email', $telefono, '$password')";
	$req = $conn->query($sql);
	

	$sql = "SELECT id FROM cliente where nombre = '$nombre' and username = '$username'";
	$cliente = $conn->query($sql);
	$info = $cliente -> fetch_array();
	$clienteID = intval($info[0]);
	
	
	$sql2 = "Insert into importancia (id_pro, id_cli, peso) values ('$idPro', '$clienteID', '$importancia')";
	$req = $conn->query($sql2);

	return $req;
}

function insertImportancia($idPro, $idCli, $importancia)
{
  global $conn;
	$sql2 = "Insert into importancia (id_pro, id_cli, peso) values ('$idPro', '$idCli', '$importancia')";
	$req = $conn->query($sql2);
	
	//$requisitoID = "select id from requisito where nombre = '$nameRequisito' and descripcion = '$descripcion'";
	
	return $req;
}

function obtenerValor($idPro, $idCli, $idReq)
{
  global $conn;
	$sql2 = "SELECT valor from valor where id_pro = $idPro and id_req = $idReq and id_cli = $idCli";
	$req = $conn->query($sql2);
	
	return $req;
}

function get_clientsNotInProject($id)
{
  global $conn;
	$sql = "select id, nombre from cliente where id not in (select id_cli from importancia where id_pro = $id) order by id";
	$clients = $conn->query($sql);
	
	return $clients;
}

function getSatisfaction($id)
{
	global $conn;
	$sql = "select id_req from esfuerzo where id_pro = $id";
	$reqs = $conn->query($sql);
	
	$cont = 0;
	
	$res = false;
	
	while ($idReqs = $reqs -> fetch_array()) {
		$idReq = $idReqs[0];

		$sql2 = "select id_cli, valor from valor where id_pro = $id and id_req = $idReq";
		$cli_vals = $conn->query($sql2);
		// sats req = 
		while ($cli_val = $cli_vals -> fetch_array()) {
			$valor = $cli_val[1];
			$sql3 = "select peso from importancia where id_pro = $id and id_cli = $cli_val[0]";
			$peso = $conn->query($sql3);
			
			$pesoC = $peso -> fetch_array();
			//echo "Req:"; echo $cli_val[0];
			//echo "Peso: "; echo $pesoC[0];
			//echo "Valor: "; echo $valor;
			//echo "<br>";
			if(! isset($array[$idReq])){
				$array[$idReq] = $pesoC[0] * $valor; 
			}else{
				$array[$idReq] = $array[$idReq] +$pesoC[0] * $valor; 
			}
			
			$cont++;
			$res = true;
		}
	}
	
	if($res){
		return $array;
	}else{
		return null;
	}
}

function getJefes(){
	global $conn;
	$sql = "select id, nombre, apellidos from jefe";
	$projects = $conn->query($sql);

	return $projects;	
}

function get_effortFromReq($id_pro, $id_req){
  global $conn;
	$sql = "Select peso from requisito, esfuerzo where esfuerzo.id_req = requisito.id and id_pro = $id_pro and id_req = $id_req";
	$req = $conn->query($sql);
	$fila = mysqli_fetch_array($req);
	return $fila;
}

function get_reqName($id)
{
  global $conn;
	$sql = "SELECT nombre FROM requisito where id = $id";
	$req = $conn->query($sql);
	$fila = mysqli_fetch_array($req);
	return $fila;
}

function set_todo($id_pro, $id_req, $valor)
{
  global $conn;
	$sql = "UPDATE esfuerzo SET todo = $valor WHERE id_pro = $id_pro and id_req = $id_req;";
	$req = $conn->query($sql);
}

function set_effort($id_pro, $valor)
{
  global $conn;
	$sql = "UPDATE proyecto SET esfuerzoMax = $valor WHERE id = $id_pro;";
	$req = $conn->query($sql);
}

function get_reqInProjecTODO($id)
{
  global $conn;
	$sql = "select id, nombre, peso from requisito, esfuerzo where requisito.id = esfuerzo.id_req and id_pro = $id and todo = 1;";
	$req = $conn->query($sql);
	
	return $req;
}

function get_reqInProjecNotTODO($id)
{
  global $conn;
	$sql = "select id, nombre from requisito, esfuerzo where requisito.id = esfuerzo.id_req and id_pro = $id and todo = 0;";
	$req = $conn->query($sql);
	
	return $req;
}

?>