<?php

session_start();

$_SESSION['search_type'] = "%";
$_SESSION['search_name'] = "%";
$_SESSION['search_desc'] = "%";
$_SESSION['search_pkg'] = "%";
$_SESSION['search_store'] = "%";
$_SESSION['search_manu'] = "%";
$_SESSION['search_loc'] = "%";
$_SESSION['search_label'] = "%";
$_SESSION['search_label2'] = "%";

header("Location: ../index.php");
exit();

?>