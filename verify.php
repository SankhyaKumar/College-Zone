<?php
	require 'core.inc.php';
	require 'connect.inc.php';

	$query1="update students set allocated=2 where app_no=".$_POST['data_app_no'];
	mysqli_query($mysql_connect,$query1);
	header('Location: index.php');
?>