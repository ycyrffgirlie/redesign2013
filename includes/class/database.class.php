<?php
/*@Author; Christine A. Black
@Version:0.1

Version 0.1 - Added the database class to the site. */
class database{
	function connect(){
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		$shell = isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';

		$devInfo = Array("login" => 'mysql:dbname=Copy_cyrff;host=localhost'
							, "user" => 'christine'
							, "password" => 'yCyrff'
							);

		if ($term == 'xterm' || $shell == '/usr/local/cpanel/bin/jailshell' || $term == 'xterm-256color'){
				
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"]) || $_SERVER["HOME"] == "/home/christine"){
				
				$login = $devInfo["login"];
				$user = $devInfo["user"];
				$password = $devInfo["password"]; 
				
			}else{
				
				/*$login = 'mysql: host=localhost;dbname=ycyrf718_Copy_cyrff';*/
				$login = 'mysql: host=localhost;dbname=ycyrf718_cyrff';
				$user = 'ycyrf718_ycyrff';
				$password = 'y1986Cyrff';
				
			}
				
		}else{
			if ($documentRoot == '/var/www/websites/redesign2013'){
				
				$login = $devInfo["login"];
				$user = $devInfo["user"];
				$password = $devInfo["password"];
				
			}else{
				
				$login = 'mysql: host=localhost;dbname=ycyrf718_Copy_cyrff';
				$user = 'ycyrf718_ycyrff';
				$password = 'y1986Cyrff';
			}
		}

		try {
			
			$database = new PDO($login,$user,$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
			PDO::ATTR_PERSISTENT => true));
			//$database ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				

		}catch (DATABASEException $error) {
			
			echo '<p>There is an error with the db. '.$error->getMessage();
			exit;
				
		}
		
		return $database;
	}
	
}

?>