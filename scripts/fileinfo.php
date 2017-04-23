<?php
/**@@Author; Christine A. Black
@Version:0.2
@todo: 

Version 0.2 - Fixed for live dev.
Version 0.1 - Added the file info script.**/

ini_set('error_reporting', E_ALL);

/*Sets $_SERvER variables*/
$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';

/*Location of the log file.*/
$filename = 'fileInfoLog.txt';

if ($term == 'xterm' || $shell == '/usr/local/cpanel/bin/jailshell'){
	
	if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
	
		$fileInfoLocation= '/var/www/websites/redesign2013/includes/class/fileInfo.class.php';
		$fileInfoLogLocation = '/var/www/websites/redesign2013/logs/'.$filename;
	
	}else{
	
		$fileInfoLocation= '/home/ycyrf718/public_html/redesign2013/includes/class/fileInfo.class.php';
		$fileInfoLogLocation = '/home/ycyrf718/logs/'.$filename;
	
	}
	
}else{

	if ($documentRoot == '/var/www/websites/redesign2013'){
	
		$fileInfoLocation= '/var/www/websites/redesign2013/includes/class/fileInfo.class.php';
		$fileInfoLogLocation = '/var/www/websites/redesign2013/logs/'.$filename;

	
	}else{
	
		$fileInfoLocation= '/home/ycyrf718/public_html/redesign2013/includes/class/fileInfo.class.php';
		$fileInfoLogLocation = '/home/ycyrf718/logs/'.$filename;
		
	}

}

include $fileInfoLocation;


$fileInfo = new fileInfo;

/*Saves the output to a variable.*/
$output = "\n".'Starting script...'."\n";
$output .= 'Script started at: '.date('H:i:s d/m/y', time()).'.'."\n";
$output .= $fileInfo ->email();
$output .= 'Script finished at: '.date('H:i:s d/m/y', time()).'.'."\n";

/*Outputs the output variable.*/
echo $output."\n";

/*Writes the output to a log.*/
try {
	$file = fopen($fileInfoLogLocation,'a+');
	
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
		
