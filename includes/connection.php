<?php ini_set('error_reporting', E_ALL);try {	$database = new PDO('mysql: host=localhost; dbname=ycyrf718_Copy_cyrff',	'ycyrf718_ycyrff', 'y1986Cyrff');}catch (DATABASEException $error) {
		echo '<p>There is an error with the db. '.$error->getMessage();	exit;
	}
?>