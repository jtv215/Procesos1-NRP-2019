<?php
function is_too_long($string)
{
  if (strlen($string) > 40) {
    return true;
  }

  return false;
}

function is_email_registered($email, $userID = -1)
{
  global $conn;
  $sql = "SELECT * FROM usuarios WHERE email='$email' AND id!='$userID'";
  $rec = $conn->query($sql);
  if ($rec->num_rows > 0)
  {
    return true;
  }

  return false;
}

function is_username_registered($username, $userID = -1)
{
  global $conn;
  $sql = "SELECT * FROM usuarios WHERE username='$username' AND id!='$userID'";
  $rec = $conn->query($sql);
  if ($rec->num_rows > 0)
  {
    return true;
  }

  return false;
}

function passwords_match($password, $password_confirmation)
{
  if ($password == $password_confirmation) {
    return true;
  }

  return false;
}

function register($email, $username, $password, $admin = 0)
{
  global $conn;
  $sql = "INSERT INTO usuarios (email,username,password,is_admin) VALUES ('$email','$username','$password',$admin)";
  $rec = $conn->query($sql);
}
?>
