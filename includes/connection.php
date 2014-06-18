<?php ini_set('error_reporting', E_ALL);global $database;if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){	$login = 'mysql: host=localhost; dbname=Copy_cyrff';	$user = 'root';	//'christine';	$password = '';	//'yCyrff';}else{	$login = 'mysql: host=localhost; dbname=ycyrf718_Copy_cyrff';	$user = 'ycyrf718_ycyrff';	$password = 'y1986Cyrff';}try {	$database = new PDO($login, $user, $password);}catch (DATABASEException $error) {
		echo '<p>There is an error with the db. '.$error->getMessage();	exit;
	}
?>