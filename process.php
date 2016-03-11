<?php 

	//include 'include/config.php';
	include 'include/functions.php';

	$price = $_POST['price'];
	$name = $_POST['item'];

	//calling insert function
	$put = insertItem($name,$price);
	


?>