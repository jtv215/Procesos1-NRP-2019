<?php
include_once "join-functions.php";

function is_password_incorrect($old_pass)
{
  $pp = $_SESSION['user']->password;
  if ($_SESSION['user']->password == $old_pass)
  {
    return false;
  }

  return true;
}

function edit($email, $username, $password)
{
  global $conn;
  global $userID;
  $admin = 0;

  if (isset($_POST['is_admin'])) {
    $admin = 1;
    echo '
    <script>
      var checkbox = document.getElementById("ckb1");
      checkbox.checked = true;
    </script>';
  } elseif ($password != false) {
    echo '
    <script>
      var checkbox = document.getElementById("checkbox");
      checkbox.parentNode.removeChild(checkbox);
    </script>';
  } else {
    echo '
    <script>
      var checkbox = document.getElementById("ckb1");
      checkbox.checked = false;
    </script>';
  }

  if ($password != false) {
    $sql = "UPDATE usuarios SET email='$email', username='$username', password='$password', is_admin='$admin' WHERE id='$userID'";
  } else {
    $sql = "UPDATE usuarios SET email='$email', username='$username', is_admin='$admin' WHERE id='$userID'";
  }

  $rec = $conn->query($sql);

  if ($userID == $_SESSION['user']->id) {
    $_SESSION['user']->email = $email;
    $_SESSION['user']->username = $username;
    if($password) {
      $_SESSION['user']->password = $password;
    }
    $_SESSION['user']->is_admin = $admin;

    if (!$password && $admin == 0) {
      echo "<script>window.location='./profile.php'</script>";
    }
  }
    
  echo '
  <script>
    var fields = document.getElementsByClassName("input100");
    fields[0].value ="' .$email .'";
    fields[1].value ="' .$username .'";
  </script>';
}

function remove($id)
{
  global $conn;
  $sql = "DELETE FROM usuarios WHERE id='$id'";
  $conn->query($sql);
}

?>
