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
if ( !isset($_POST['edit_type']) )
{
  die("edit_type not set !");
}
else
{
  $edit_type = trim((string)$_POST['edit_type']);
}
if ( !isset($_POST['edit_name']) )
{
  die("edit_name not set !");
}
else
{
  $edit_name = trim((string)$_POST['edit_name']);
  if ( empty($edit_name) )
  {
      die("edit_name should not be empty !");
  }
}
if ( !isset($_POST['edit_desc']) )
{
  die("edit_desc not set !");
}
else
{
  $edit_desc = trim((string)$_POST['edit_desc']);
}
if ( !isset($_POST['edit_pkg']) )
{
  die("edit_pkg not set !");
}
else
{
  $edit_pkg = trim((string)$_POST['edit_pkg']);
}
if ( !isset($_POST['edit_quantity']) )
{
  die("edit_quantity not set !");
}
else
{
  $edit_quantity = (int)$_POST['edit_quantity'];
}
if ( !isset($_POST['edit_store']) )
{
  die("edit_store not set !");
}
else
{
  $edit_store = trim((string)$_POST['edit_store']);
}
if ( !isset($_POST['edit_ref']) )
{
  die("edit_ref not set !");
}
else
{
  $edit_ref = trim((string)$_POST['edit_ref']);
}
if ( !isset($_POST['edit_manu']) )
{
  die("edit_manu not set !");
}
else
{
  $edit_manu = trim((string)$_POST['edit_manu']);
}
if ( !isset($_POST['edit_price']) )
{
  die("edit_price not set !");
}
else
{
  $edit_price = (float)$_POST['edit_price'];
}
if ( !isset($_POST['edit_loc']) )
{
  die("edit_loc not set !");
}
else
{
  $edit_loc = trim((string)$_POST['edit_loc']);
}
if ( !isset($_POST['edit_label']) )
{
  die("edit_label not set !");
}
else
{
  $edit_label = trim((string)$_POST['edit_label']);
}
if ( !isset($_POST['edit_label2']) )
{
  die("edit_label2 not set !");
}
else
{
  $edit_label2 = trim((string)$_POST['edit_label2']);
}

$request = $bdd->prepare("UPDATE components
            SET type = ?,
            name = ?,
            description = ?,
            package = ?,
            quantity = ".$edit_quantity.",
            store = ?,
            store_ref = ?,
            manufacturer = ?,
            price = ".$edit_price.",
            location = ?,
            label = ?,
            label_extra = ? WHERE components.id = ".$id);

try
{
  $request->execute(array(
                $edit_type,
                $edit_name,
                $edit_desc,
                $edit_pkg,
                $edit_store,
                $edit_ref,
                $edit_manu,
                $edit_loc,
                $edit_label,
                $edit_label2 ));
}
catch(Exception $e)
{
  die('Error : '.$e->getMessage());
}

$request->closeCursor();

header("Location: ../edit.php?id=".$id);
exit();

?>