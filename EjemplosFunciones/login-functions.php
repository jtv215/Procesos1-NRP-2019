<?php
function verificar_login($username, $password, &$result)
{
  global $conn;
  $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
  $rec = $conn->query($sql);
  if ($rec->num_rows > 0)
  {
    $result = mysqli_fetch_object($rec);
    return 1;
  }

  return 0;
}
?>
