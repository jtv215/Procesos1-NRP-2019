<?php 

function get_users()
{
  global $conn;
  $sql = "SELECT * FROM usuarios";
	$users = $conn->query($sql);
	
	return $users;
}

?>