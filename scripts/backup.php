<?php
/**@@author:Christine Black
@Version:0.1
@todo: backup database/

Version 0.1 - Added the backup script.**/
/*Set variables*/
$sapi_name = php_sapi_name();
$xterm = isset($_SERVER["TERM"] )?$_SERVER["TERM"] :'';
$pwd = isset($_SERVER["PWD"])?$_SERVER["PWD"]:'';
$home = isset($_SERVER["HOME"])?$_SERVER["HOME"]:'';
$document_root = isset($_SERVER["DOCUMENT_ROOT"])?$_SERVER["DOCUMENT_ROOT"]:'';


//echo $sapi_name."\n";

if($xterm== 'xterm'){

	if(preg_match( '%/var/www/websites/redesign2013%', $pwd) || $home == "/home/christine"){
		
		$rootLocation = '/var/www/websites/'; 
		$flle_backup = '/var/www/websites/backup/files_'.date('d-m-Y:H:i:s').'.tar.gz';
		$filesToBeBackup = 'redesign2013';
		
	}else{
	
		 $rootLocation = '/home/ycyrf718/';
		 $flle_backup = '/home/ycyrf718/backup/files_'.date('d-m-Y:H:i:s').'.tar.gz';
		 $filesToBeBackup = ' /public_html /includes';
	
	}

}else{

	if($document_root == '/var/www/websites/redesign2013'){
	
		$rootLocation = '/var/www/websites/'; 
		$flle_backup = '/var/www/websites/backup/files_'.date('d-m-Y:H:i:s').'.tar.gz';
		$filesToBeBackup = '/redesign2013';
	
	}else{
	
		$rootLocation = '/home/ycyrf718/';
		$flle_backup = '/home/ycyrf718/backup/files_'.date('d-m-Y:H:i:s').'.tar.gz';
		 $filesToBeBackup = ' /public_html /includes';
	
	}

}

//die();
$attachment = '';

/*Creates the backup.*/
$cmd =' cd '.$rootLocation.'&& tar -czf '.$flle_backup.' '.$filesToBeBackup;

echo 'Now executing:'. $cmd .' So please wait.'."\n";

$output = array();
$output[1] = exec($cmd, $output);

echo '<pre>';
print_r($output);
echo '</pre>';

$cmd = 'tar dzf '.$flle_backup;

echo $cmd;

$output[2] = exec($cmd, $output);

echo '<pre>';
print_r($output);
echo '</pre>';

/*Creats email and sends it.*/
$file = escapeshellarg($flle_backup);
$mime = shell_exec('file -b --mime-type '.$file);

$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

//die();
if ($flle_backup){
	
	$filename = str_replace('/home/ycyrf718/backup/', '',$flle_backup);
	$content = chunk_split(base64_encode(file_get_contents($flle_backup)));
	
	if ($filename){
		
		$attachment .= '--'.$mime_boundary."\n";
		$attachment .= 'Content-Type: '.$mime. 'name="'.$filename. '"'."\n";
		$attachment .= 'Content-Transfer-Encoding: base64'."\n";
		$attachment .= 'Content-Disposition: attachment; filename="'.$filename.'"'."\r\n\r\n";
		$attachment .= $content;
	}
	
	$html = '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>
	<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\'); background-color: #800080; width:100%;" link="ffd700" alink="ffd700" >
		<table>
			<tr>
				<td style="width:5%">&nbsp;</td>
				<td style="width:93%">
					<p><font color="ffd700">Backup complete.</font></p> 
					<p><font color="ffd700">One nutty fan</font></p>
				</td>
			</tr>
		</table>
	</body>
</html>';

	$txt = 'Backup complete.
Thanks,

One nutty fan';
	
}else{

	$html = '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>Couldn\'t create file.</font></p>
	<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\'); background-color: #800080; width:100%;" link="ffd700" alink="ffd700" >
		<table>
			<tr>
				<td style="width:5%">&nbsp;</td>
				<td style="width:93%">
					<p><font color="ffd700">Backup failed.</font></p>
					<p><font color="ffd700">One nutty fan</font></p>
				</td>
			</tr>
		</table>
	</body>
</html>';

	$txt = 'Backup failed.
Thanks,

One nutty fan';

}


$to ='ycyrffgroupie@gmail.com';
$subject= "Backup";

$headers ='MIME-Version: 1.0'."\r\n";
$headers .= 'Content-Type: multipart/alternative; boundary='.$mime_boundary. "\r\n";
$headers .='From: "Webmistress" <webmistress@ycyrffgroupie.co.uk>'. "\r\n";	
//foreach ()
 
 if ($attachment){
	
	$body = "This is a multi-part message in MIME format.\r\n\r\n" .
				'--'.$mime_boundary."\r\n".
				'Content-Type: text/plain; charset="utf-8"'."\r\n".
				'Content-Transfer-Encoding:7-bit'."\r\n\r\n".$txt."\r\n\r\n".
				"--{$mime_boundary}\r\n" .
                                "Content-Type:text/html; charset=\"utf-8\"\r\n" .
                                "Content-Transfer-Encoding: 7bit\r\n\r\n" .
				$html."\r\n".
				$attachment; 
}else{
	
	$body = "This is a multi-part message in MIME format.\r\n\r\n" .
			'--'.$mime_boundary."\r\n".
			'Content-Type: text/plain; charset="utf-8"'."\r\n".
			'Content-Transfer-Encoding:7-bit'."\r\n\r\n".$txt."\r\n\r\n".
			"--{$mime_boundary}\r\n" .
			"Content-Type:text/html; charset=\"utf-8\"\r\n" .
			"Content-Transfer-Encoding: 7bit\r\n\r\n" .
			$html."\r\n"; 
				
}

//echo $body;

mail($to, $subject,$body, $headers);

?>