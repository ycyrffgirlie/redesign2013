<?php
/**@@author:Christine Black
@Version:0.2
@todo: 

Version 0.2 - Fixed for live dev.
Version 0.1 - Added the sitemap script.**/

/*Sets $_SERvER variables*/
$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';

/*Setting location for files*/
$filename = 'sitemap.xml';
$sitemapFilename = 'sitemapLog.txt';

if ($term == 'xterm' || $shell == '/usr/local/cpanel/bin/jailshell'){

	if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"]) || $_SERVER["HOME"] == "/home/christine"){
	
		require("/var/www/websites/redesign2013/includes/connection.php");
		$sitemapLocation = '/var/www/websites/redesign2013/logs/'.$filename;
		$sitemapLogLocation = '/var/www/websites/redesign2013/logs/'.$sitemapFilename;
	
	}else{
	
		require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		$sitemapLocation = '/home/ycyrf718/public_html/'.$filename;
		$sitemapLogLocation = '/home/ycyrf718/logs/'.$sitemapFilename;
	
	}

}else{

	if ($documentRoot == '/var/www/websites/redesign2013'){
	
		require("/var/www/websites/redesign2013/includes/connection.php");
		$sitemapLocation = '/var/www/websites/redesign2013/logs/'.$filename;
		$sitemapLogLocation = '/var/www/websites/redesign2013/logs/'.$sitemapFilename;
	
	}else{
	
		require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		$sitemapLocation = '/home/ycyrf718/public_html/'.$filename;
		$sitemapLogLocation = '/home/ycyrf718/logs/'.$sitemapFilename;
		
	}

}

$output = "\n".'Starting script...'."\n";
$output .= 'Script started at: '.date('H:i:s d/m/y', time()).'.'."\n";

/*Strating to create content for sitemap.*/
$sitemap ='<?xml version="1.0" encoding="UTF-8"?>'." \n";
$sitemap .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'." \n";

$sql = "SELECT filename, datelastmodified, includedinsitemap FROM pages WHERE filename NOT LIKE '%/images%'
	";
/*Get details of files that needs to be included.*/
try {
	$query = $database ->prepare($sql);
	$query ->execute();
	
} catch(PDOException $error){
		
	echo 'Error with query. '.$error->getMessage();
}

if( $query){
	while ($fileinfo = $query ->fetch()){
			
			if($fileinfo["includedinsitemap"] == 1){
			
				$sitemap .= '		
	<url>
		<loc>http://www.ycyrffgroupie.co.uk'.$fileinfo['filename'].'</loc>
		<lastmod>'.substr($fileinfo['datelastmodified'],0,-9).'</lastmod>
	</url>'." \n";
			
			}
	}
}

$sitemap .= '</urlset>';

/*Delete the ol file*/
unlink($sitemapLocation);

$output .= 'Creating file.'."\n";

/*Writes content  to files and create emails  contents*/
$file = fopen($sitemapLocation,'c');

if ($file){
	fwrite($file, $sitemap);
	
	$content = chunk_split(base64_encode(file_get_contents($sitemapLocation)));
	
	fclose($file);
	$html = '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>
	<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\'); background-color: #800080; width:100%;" link="ffd700" alink="ffd700" >
		<table>
			<tr>
				<td style="width:5%">&nbsp;</td>
				<td style="width:93%">
					<p><font color="ffd700">Google sitemap created. It is
					<a style="color: #ffd700;" href="http://www.ycyrffgroupie.co.uk/sitemap.xml">here</a>.</font></p>
					<br>
					<br>
					<p><font color="ffd700">Thanks,
					<br>
					One nutty fan.</font></p>
				</td>
			</tr>
		</table>
	</body>
</html>';

$txt = 'Google sitemap created. It is here: http://www.ycyrffgroupie.co.uk/sitemap.xml .
Thanks,

One nutty fan.';
}else{
	$html = '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>
	<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\'); background-color: #800080; width:100%;" link="ffd700" alink="ffd700" >
		<table>
			<tr>
				<td style="width:5%">&nbsp;</td>
				<td style="width:93%">
					<p><font color="ffd700">Couldn\'t create the sitemap xml for Google.</font></p>
					<p><font color="ffd700">Please fix it.</font></p>
					<br>
					<br>
					<p><font color="ffd700">Thanks,
					<br>
					One nutty fan.</font></p>
				</td>
			</tr>
		</table>
	</body>
</html>';

$txt = strip_tags($html );
}



$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$to = 'ycyrffgroupie@gmail.com';
$subject = 'Sitemap';
$headers ='MIME-Version: 1.0'."\r\n";
$headers .= 'Content-Type: multipart/alternative; boundary='.$mime_boundary. "\r\n";
$headers .='From: "Webmistress" <webmistress@ycyrffgroupie.co.uk>'. "\r\n";


if ($content){
	$attachment  = '';
	$attachment .= '--'.$mime_boundary."\r\n";
	$attachment .= 'Content-Type: application/xml name="'.$filename. '"'."\r\n";
	$attachment .= 'Content-Transfer-Encoding: base64'."\r\n";
	$attachment .= 'Content-Disposition: attachment; filename="'.$filename.'"'."\r\n\r\n";
	$attachment .= $content;
	
	$message = "This is a multi-part message in MIME format.\r\n\r\n" .
		'--'.$mime_boundary."\r\n".
		'Content-Type: text/plain; charset="utf-8"'."\r\n".
		'Content-Transfer-Encoding:7-bit'."\r\n\r\n".$txt."\r\n\r\n".
		"--{$mime_boundary}\r\n" .
		"Content-Type:text/html; charset=\"utf-8\"\r\n" .
		"Content-Transfer-Encoding: 7bit\r\n\r\n" .
		$html."\r\n\r\n".
		$attachment; 
				
}else{
	$message = "This is a multi-part message in MIME format.\r\n\r\n" .
		'--'.$mime_boundary."\r\n".
		'Content-Type: text/plain; charset="utf-8"'."\r\n".
		'Content-Transfer-Encoding:7-bit'."\r\n\r\n".$txt."\r\n".
		"--{$mime_boundary}\r\n" .
		"Content-Type:text/html; charset=\"utf-8\"\r\n" .
		"Content-Transfer-Encoding: 7bit\r\n\r\n" .
		$html."\r\n";
}

/*Sends the email*/
if (mail($to,$subject,$message, $headers)){
	$output .= 'Email was sent.'."\n";
			
}else{
			
	$output .= "Email wasn't sent."."\n";
			
}

$output .= 'Script finished at: '.date('H:i:s d/m/y', time()).'.'."\n";

/*Outputs the output variable.*/
echo $output."\n";

/*Writes the output to a log.*/
try {
	$file = fopen($sitemapLogLocation,'a+');
	
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

