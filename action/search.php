<?php

session_start();

if ( isset($_POST['search_type']) )
{
  $_SESSION['search_type'] = htmlspecialchars((string)$_POST['search_type']);

  if ( strlen($_SESSION['search_type']) == 0 )
  {
    $_SESSION['search_type'] = "%";
  }
}
if ( isset($_POST['search_name']) )
{
  $_SESSION['search_name'] = htmlspecialchars((string)$_POST['search_name']);

  if ( strlen($_SESSION['search_name']) == 0 )
  {
    $_SESSION['search_name'] = "%";
  }
}
if ( isset($_POST['search_desc']) )
{
  $_SESSION['search_desc'] = htmlspecialchars((string)$_POST['search_desc']);

  if ( strlen($_SESSION['search_desc']) == 0 )
  {
    $_SESSION['search_desc'] = "%";
  }
}
if ( isset($_POST['search_pkg']) )
{
  $_SESSION['search_pkg'] = htmlspecialchars((string)$_POST['search_pkg']);

  if ( strlen($_SESSION['search_pkg']) == 0 )
  {
    $_SESSION['search_pkg'] = "%";
  }
}
if ( isset($_POST['search_store']) )
{
  $_SESSION['search_store'] = htmlspecialchars((string)$_POST['search_store']);

  if ( strlen($_SESSION['search_store']) == 0 )
  {
    $_SESSION['search_store'] = "%";
  }
}
if ( isset($_POST['search_manu']) )
{
  $_SESSION['search_manu'] = htmlspecialchars((string)$_POST['search_manu']);

  if ( strlen($_SESSION['search_manu']) == 0 )
  {
    $_SESSION['search_manu'] = "%";
  }
}
if ( isset($_POST['search_loc']) )
{
  $_SESSION['search_loc'] = htmlspecialchars((string)$_POST['search_loc']);

  if ( strlen($_SESSION['search_loc']) == 0 )
  {
    $_SESSION['search_loc'] = "%";
  }
}
if ( isset($_POST['search_label']) )
{
  $_SESSION['search_label'] = htmlspecialchars((string)$_POST['search_label']);

  if ( strlen($_SESSION['search_label']) == 0 )
  {
    $_SESSION['search_label'] = "%";
  }
}
if ( isset($_POST['search_label2']) )
{
  $_SESSION['search_label2'] = htmlspecialchars((string)$_POST['search_label2']);

  if ( strlen($_SESSION['search_label2']) == 0 )
  {
    $_SESSION['search_label2'] = "%";
  }
}

header("Location: ../index.php");
exit();

?>