<?php

include "../private/constant.php";

session_start();

if ( !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin'] )
{
  die("you are not an admin !");
}

try
{
  $bdd = new PDO($cfg_mysql_pdo, $cfg_mysql_login, $cfg_mysql_password);
}
catch(Exception $e)
{
  die('Error : '.$e->getMessage());
}

if ( !isset($_POST['id']) )
{
  die("id not set !");
}
else
{
  $id = (int)$_POST['id'];
}

$request = $bdd->prepare("DELETE FROM components WHERE components.id = ?");

try
{
  $request->execute(array($id));
}
catch(Exception $e)
{
  die('Error : '.$e->getMessage());
}

$request->closeCursor();

header("Location: ../index.php");
exit();

?>