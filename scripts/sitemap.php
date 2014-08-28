<?php
/**@@author:Christine Black
This generates the sitemap.
**/

echo 'Starting....'."\n";

$sitemap ='<?xml version="1.0" encoding="UTF-8"?>'." \n";
$sitemap .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'." \n";

if (file_exists('/home/ycyrf718/public_html/redesign2013/includes/connection.php')){
	require('/home/ycyrf718/public_html/redesign2013/includes/connection.php');
}else{
	require("connection.php");
}

$sql = "SELECT filename, datelastmodified FROM pages WHERE filename NOT LIKE '%/images%'
	AND filename NOT LIKE '%/band.html%'
	AND filename NOT LIKE '%/contact.php%'
	AND filename NOT LIKE '%/me.html%'
	AND filename NOT LIKE '%/profiles/submitprofile.php%'
	AND filename NOT LIKE '%/includes/header.php%'";

//global $database;

try {
	if ($database ){
		$query = $database ->prepare($sql);
		$query ->execute();
	}else{
		echo 'database is not set. database is: '.$database .'. '."\n";
	}
	
} catch (Exception $error) {
	
	echo $error ->getMessage();
}

if( $query){
	while ($fileinfo = $query ->fetch()){
			$sitemap .= '		<url>
			<loc>http://www.ycyrffgroupie.co.uk'.$fileinfo['filename'].'</loc>
			<lastmod>'.substr($fileinfo['datelastmodified'],0,-9).'</lastmod>
			</url>'." \n";
	}
}

$sitemap .= '</urlset>';

unlink('/home/ycyrf718/public_html/sitemap.xml');

echo 'Creating file'."\n";

$filename = 'sitemap.xml';
$file = fopen('/home/ycyrf718/public_html/'.$filename,'c');

if ($file){
	fwrite($file, $sitemap);
	
	$content = chunk_split(base64_encode(file_get_contents('/home/ycyrf718/public_html/'.$filename)));
	
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

$txt = 'Google sitemap created. It is here: http://www.ycyrffgroupie.co.uk/sitemap.xml .';
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

$txt = strip_tags($html );

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

mail($to,$subject,$message, $headers);
?>
</body>
