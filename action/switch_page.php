<?php

session_start();

if ( isset($_POST['newPage']) )
{
	$_SESSION['page'] = (int)$_POST['newPage'];
}

header("Location: ../index.php");
exit();

?>