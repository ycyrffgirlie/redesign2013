<?php
/*@Author; Christine A. Black
@Version:0.5
@todo: 

Version 0.3 - Changed the db connectuo into a class.
Version 0.4 - Added the visitor e-mail class to the site.
Version 0.3 - Sorted out writing to file when running this script from the browser.
Version 0.2 - Put in live server details.
Version 0.1 - Added the visitor email script.*/

$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';

/*Location of the log file.*/
$filename = 'visitorsEmailLog.txt';
$databaseClass = "class/database.class.php";

/*Location of the files.*/
if ($term == 'xterm' || $shell == '/usr/local/cpanel/bin/jailshell' || $term == 'xterm-256color'){
	
	if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
		
		$databaseLocation = "/var/www/websites/redesign2013/includes/".$databaseClass;
		$visitorEmailClassLoxation = '/var/www/websites/redesign2013/includes/class/visitorEmail.class.php';
		$visitorsEmailLogLoxation = '/var/www/websites/redesign2013/logs/'.$filename;
		
	}else{
	
		$databaseLocation = "/home/ycyrf718/public_html/redesign2013/includes/".$databaseClass;
		$visitorEmailClassLoxation = '/home/ycyrf718/redesign2013/includes/class/visitorEmail.class.php';
		$visitorsEmailLogLoxation = '/home/ycyrf718/redesign2013/logs/'.$filename;
		
	}
	
}else{
	if ($documentRoot == '/var/www/websites/redesign2013'){
	
		$databaseLocation = "/var/www/websites/redesign2013/includes/".$databaseClass;
		$visitorEmailClassLoxation = '/var/www/websites/redesign2013/includes/class/visitorEmail.class.php';
		$visitorsEmailLogLoxation = $_SERVER["DOCUMENT_ROOT"].'/logs/'.$filename;
		
	}else{
		
		$databaseLocation = "/home/ycyrf718/public_html/redesign2013/includes/".$databaseClass;
		$visitorEmailClassLoxation = '/home/ycyrf718/redesign2013/includes/class/visitorEmail.class.php';
		$visitorsEmailLogLoxation = '/home/ycyrf718/redesign2013/logs/'.$filename;
		
	}
}

/*the included files.*/
require $databaseLocation;
include $visitorEmailClassLoxation;

/*Set a new visitor class.*/
$db = new database;
$visitor = new visitorEmail;

$database = $db ->connect();

/*Saves the output to a variable.*/
$output = "\n".'Starting script...'."\n";
$output .= 'Script started at: '.date('H:i:s d/m/y', time()).'.'."\n";
$output .= $visitor ->email($database)."\n";
$output .= 'Script finished at: '.date('H:i:s d/m/y', time()).'.'."\n";

/*Outputs the output variable.*/
echo $output."\n";

/*Writes the output to a log.*/
try {
	$file = fopen($visitorsEmailLogLoxation,'a+');
	
	if ($file){
		
		fwrite($file, $output);
		fclose($file);
		
		}else{
		
		throw new Exception("Couldn't open file.");
		
	}
	
}catch(Exception $error){
	
	echo 'Error: '.$error ->getMessage(),"\n";
	print_r($error->getTrace());
	echo 'Exception Code:'.$error->getCode()."\n";
	echo 'Line :'.$error->getLine().' - File:'.$error->getFile()."\n";
	
}

?>