<?php
/*@Author; Christine A. Black
@Version:0.1
@todo: 

Version 0.1 - Added the contact class to the site. */

class contact{
	
	/*Sends an emai.*/
	function contact_email($name,$website,$email,$message,$filename){
	
		$to ='"Christine" <ycyrffgroupie@gmail.com>';
		
		if ($filename == '/discography.html'){
			$subject = 'Discography / Discograff';
		}elseif (preg_match('%lyrics%',$filename)){
			$subject = 'Lyrics / Geiriau';
		}else{
			$subject = 'Website / Gwe Safle';
		}
		
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x".$semi_rand ."x";
		
		$headers ='From: "Webmistress" <webmistress@ycyrffgroupie.co.uk>'."\r\n";
		$headers .='Reply-To: "'.$name.'"<' .$email.'>'."\r\n";
		$headers .='MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: multipart/alternative; boundary='.$mime_boundary."\r\n";
		
		$html =  '<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd\">
<html>
<head></head>
		
<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\'); background-color: #800080; width:100%;">
		
<table>
		
	<tr>
		<td style="width:5%;">
		</td>
		<td style="width:93%;">
		<table>
			<tr>
				<td style="width: 50%;text-align:right"><p style="color: #ffd700;">Name/<span lang="cy">Enw:</span>&nbsp;</p></td>
				<td style="width: 50%;text-align:left"><p style="color: #ffd700;">'.$name.'</p></td>
			</tr>
			<tr>
				<td style="width: 50%;text-align:right"><p style="color: #ffd700;">Website/<span lang="cy">Gwe safle:</span>&nbsp;</p></td>
				<td style="width: 50%;text-align:left"><a style=\"color: #ffd700;" href="'.$website.'">'.$website.'</a></td>
			</tr>
			<tr>
				<td style="width: 50%;text-align:right"><p style="color: #ffd700;">E-mail/<span lang="cy">E-bost:</span>&nbsp;</p></td>
				<td style="width: 50%;text-align:left"><a style="color: #ffd700;" href="mailto:'.$email.'">'.$email.'</a></td>
			</tr>
			<tr>
				<td style="width: 50%;text-align:right"><p style="color: #ffd700;">Message/<span lang="cy"> Neges:</span></p> </td>
				<td style="width: 50%;text-align:left"><p style="color: #ffd700;">'.$message.'</p></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>';
	
	$txt = strip_tags(str_replace('&nbsp;',' ',$html));
	
	$body = 'This is a multi-part message in MIME format.'."\r\n\r\n".
'--'.$mime_boundary."\r\n".
'Content-Type: text/plain; charset="utf-8"'."\r\n".
'Content-Transfer-Encoding:7-bit'."\r\n\r\n".$txt."\r\n".
'--'.$mime_boundary."\r\n".
'Content-Type: text/html; charset="utf-8"'. "\r\n".
'Content-Transfer-Encoding: 7-bit'. "\r\n\r\n".$html."\r\n";

	
		mail($to,$subject,$body, $headers);
	
	}
	
	/**/
	function contact_form_success($name,$website,$email,$message,$filename){
	
		$output = '';
		
		$this ->contact_email($name,$website,$email,$message,$filename);
		
		$output = '
<div id="overlay"></div>
<div class="contactScreen" contactScreen" style="display: block;">
	
	<a class="close" href="">X</a>
	<div class="contactContainer">
		<p>Thank you, your email has been sent. I will be in touch soon.</p>
		<p>Diolch i chi, eich e-bost wedi cael ei anfon. Byddaf yn cysylltu &acirc; chi cyn bo hir</p>
	</div>
</div>
		';
		
		return $output;
	
	}
	
	/*This displays the submit contact form*/
	function display_contact_form($filename){
	
		$output = '';
		
		$output = '
<div class="contactScreen"'.(isset($_GET["v"] )?$_GET["v"] == 'fail'?' style="display: block;"':' style="display: block;"':'').'>
	
	<a class="close" href="">X</a>
	<div class="contactContainer">
	<form id="contactForm" name="contactForm" method="post" action="'.$filename.'">
	'. (isset($_GET["v"] )?$_GET["v"] == 'fail'? '<p class="white">Please check that you have enter your name and email address correctly.
	<br />
	Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad e-bost yn gywir.</p>'  :   '<div id="error">
	<p class="white">Please check that you have enter your name and email address correctly.
	<br />Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad e-bost yn gywir.</p>
</div>':'' ).'			
		<p>Please fill the form to contact the webmistress. Llenwch y ffurflen i gysylltu &acirc;\'r webmistress.</p>
		<p class="white">* Required information</p>
			<div class="fieldline">
				<div class="fieldname">
					<p>Name/<span lang="cy">Enw:</span><span class="white">*</span>&nbsp;</p>
				</div>
				<div class="field">
					<p><input type="text" size="20" name="name"'.(isset($_SESSION["contactName"])?' value="'.$_SESSION["contactName"].'"':'').'></p>
				</div>
			</div>
			
			<div class="fieldline">
				<div class="fieldname">
					<p>Website/<span lang="cy">Gwe safle:</span>&nbsp;</p>
				</div>
				<div class="field">
					<p><input type="text" size="20" name="website"'.(isset($_SESSION["contactWebsite"])?' value="'.$_SESSION["contactWebsite"].'"':'').'></p>
				</div>
			</div>
		
			<div class="fieldline">
				<div class="fieldname">
					<p>E-mail/<span lang="cy">E-bost:</span><span class="white">*</span>&nbsp;</p>
				</div>
				<div class="field">
					<p><input type="text" size="20" name="email"'.(isset($_SESSION["conactEmail"])?' value="'.$_SESSION["conactEmail"].'"':'').'></p>
				</div>
			</div>
			<div>
				<div align="center">
					<p>Message/<span lang="cy"> Neges:</span></p> 
					<br><textarea cols="40" rows="5" name="message">'.(isset($_SESSION["conactMessage"])?' value="'.$_SESSION["conactMessage"].'"':'').'</textarea>
				</div>
			</div>
		
		<input type="submit" name="submit" value="submit"><input type="reset" name="reset" value="reset">
		
	</form>
	</div>
	
</div>';
		
		return $output;
	
	}
	
	/**/
	/*function(){
	
	}*/
	
}
?>