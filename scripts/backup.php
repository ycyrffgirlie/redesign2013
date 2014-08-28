<?php
$sapi_name = php_sapi_name();

//echo $sapi_name."\n";
if ($_SERVER["GATEWAY_INTERFACE"] = "CGI/1.1"){

}
$attachment = '';

$flle_backup = '/home/ycyrf718/backup/files_'.date('d-m-Y:H:i:s').'.tar.gz';
$cmd =' cd /home/ycyrf718/ && tar -czf '.$flle_backup.' /public_html /includes';

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

$file = escapeshellarg($flle_backup);
$mime = shell_exec('file -b --mime-type '.$file);

$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

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
	<p><font color="ffd700">Backup complete.</font></p> 
	<p><font color="ffd700">One nutty fan</font></p>
	</body>
</html>';
	
}else{

	$html = '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>Couldn\'t create file.</font></p>
	<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\'); background-color: #800080; width:100%;" link="ffd700" alink="ffd700" >
	<p><font color="ffd700">
	<p><font color="ffd700">One nutty fan</font></p>
	</body>
</html>';

}


$to ='ycyrffgroupie@gmail.com';
$subject= "Backup";

$headers ='MIME-Version: 1.0'."\r\n";
$headers .= 'Content-Type: multipart/mixed; boundary='.$mime_boundary. "\r\n";
$headers .='From: "Webmistress" <webmistress@ycyrffgroupie.co.uk>'. "\r\n";	
//foreach ()
 
 if ($attachment){
	
	$body = "This is a multi-part message in MIME format.\r\n\r\n" .
"--{$mime_boundary}\r\n" .
                                "Content-Type:text/html; charset=\"utf-8\"\r\n" .
                                "Content-Transfer-Encoding: 7bit\r\n\r\n" .
				$html."\r\n".
				$attachment; 
}else{
	
	$body = "This is a multi-part message in MIME format.\r\n\r\n" .
"--{$mime_boundary}\r\n" .
                                "Content-Type:text/html; charset=\"utf-8\"\r\n" .
                                "Content-Transfer-Encoding: 7bit\r\n\r\n" .
				$html."\r\n"; 
				
}

mail($to, $subject,$body, $headers);

?>