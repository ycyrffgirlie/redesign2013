<?php
/*@Author; Christine A. Black
@Version:0.2
@todo: 

Version 0.2 - Fixed a php warning.
Version 0.1 - Added the fanProfile class to the site. */

class fanProfile{
	
	/*This displays the submit fan profile form.*/
	function display_submit_form(){
		
		$output = "

<form name=\"profileForm\" method=\"post\" action=\"submitprofile.php\" id=\"profileForm\">

". (isset($_GET["v"] )?$_GET["v"] == 'fail'? '<p class="white">Please check that you have enter your name and email address correctly.
	<br />
	Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad e-bost yn gywir.</p>'  :   '<div id="error">
	<p class="white">Please check that you have enter your name and email address correctly.
	<br />Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad e-bost yn gywir.</p>
</div>':'' )."

<p class=\"white\">* Required information</p>
<div id=\"content\">
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Name/<span lang=\"cy\">Enw:</span><span class=\"white\">*</span>&nbsp;</p></div>
		<div class=\"field\">
			<p><input type=\"text\" size=\"20\" name=\"name\" ".(isset($_SESSION["profileName"])? 'value="'.$_SESSION["profileName"].'"' : '')."></p>
		</div>
	</div>
	<div class=\"clear\">
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Location/<span lang=\"cy\">LLe:</span>&nbsp;</p></div>
		<div class=\"field\">
			<p><input type=\"text\" size=\"20\" name=\"location\" ".(isset($_SESSION["profileLocation"]) ? 'value="'.$_SESSION["profileLocation"].'"' : '')."></p>
		</div>
	</div>
	<div class=\"clear\">
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Website/<span lang=\"cy\">Gwe safle:</span>&nbsp;</p></div>
		<div class=\"field\">
			<p><input type=\"text\" size=\"20\" name=\"website\" ".(isset($_SESSION["profilWebsite"])? 'value="'.$_SESSION["profilWebsite"].'"' : '')."></p>
		</div>
	</div>
	<div class=\"clear\">
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>E-mail/<span lang=\"cy\">E-bost:</span><span class=\"white\">*</span>&nbsp;</p></div>
		<div class=\"field\"><p><input type=\"text\" size=\"20\" name=\"email\" ".(isset($_SESSION["profileEmail"])? 'value="'.$_SESSION["profileEmail"].'"' : '' )."></p></div>
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\" style=\"width: 250px;padding-right: 5px;\">
			<p>Do you wish for your email address to be hidden?</p>
		</div>
		<div class=\"field\" style=\"width: 60px;padding-left:75px;\">
			<p>
				<select name=\"hideEmailAddress\">
					<option>Yes</option>
					<option>No</option>
				</select>
			</p>
		</div>
	</div>
	<div>
		<div align=\"center\">
			<p>Where did you first heard about Y Cyrff/<span lang=\"cy\"> LLe naethoch chi cyntaf wedi clywed am Y Cyrff?</span></p> 
			<br><textarea cols=\"20\" rows=\"5\" name=\"heardcyrff\">".(isset($_SESSION["profileHeardcyrff"])? $_SESSION["profileHeardcyrff"] : '' )."</textarea>
		</div>
	</div>
	<div>
		<p>Favourite Cyrff song/<span lang=\"cy\">Hoff g&acirc;n Cyrff:</span>&nbsp;
		<br />
		<input type=\"text\" size=\"20\" name=\"favesong\" ".(isset($_SESSION["profileFavesong"])? 'value="'.$_SESSION["profileFavesong"].'"' : '')."></p>
	</div>
	<div class=\"clear\">
	</div>
	<div>
		<p>Favoutite Cyrff album/<span lang=\"cy\">Hoff albwn Cyrff:</span>&nbsp;
		<br />
		<input type=\"text\" size=\"20\" name=\"favealbum\" ".(isset($_SESSION["profileFavealbum"] )? 'value="'.$_SESSION["profileFavealbum"].'"' : '')."></p>
	</div>
	<div>
		<div align=\"center\">
			<p>Other comments/<span lang=\"cy\"> Eraill sywl:</span></p>
			<br><textarea cols=\"20\" rows=\"5\" name=\"comments\">".(isset($_SESSION["profileComments"])? $_SESSION["profileComments"] : '')."</textarea>
		</div>
	</div>

	<br>
	<br>

	<div style=\"margin:0px auto; width:130px;\">
		<input type=\"submit\" name=\"submit\" value=\"submit\"><input type=\"reset\" name=\"reset\" value=\"reset\">
	</div>

</div>
</form>

<div class=\"clear\"></div>" ;
		
		return $output;
		
	}
	
	/*This displays the fan profile.*/
	function get_profile($profileid,$title){
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
	
		$sql = $this ->get_profile_query($profileid);
	
		$query = $database ->prepare($sql);
		$query ->execute();
	
		$profileinfo = $query ->fetch();
	
		if ($profileinfo){
	
			$output = '<h1> '.( isset($title)?$title:$profileinfo['name'].'\'s profile') .'</h1>
			<p><strong>Name/Enw:</strong>&nbsp;'.$profileinfo['name'].'
			<br>
			<strong>Location/<span lang="cy">LLe:</span></strong>&nbsp;'.$profileinfo['place'].'
			<br>
			<strong>Website/<span lang="cy">Gwe safle:</span></strong>&nbsp;'.$profileinfo['website'].'
			<br>
			<strong>E-mail/<span lang="cy">E-bost:</span></strong>&nbsp;'.
			($profileinfo["email_hidden"] == 0?$profileinfo['email']:'').'
			<br>
			<strong>Where first heard about Cyrff?/<span lang="cy">LLe naethoch chi cyntaf wedi clywed am Y Cyrff?</span></strong>&nbsp;'.$profileinfo['firstheard'].'
			<br>
			<strong>Favourite Cyrff song/<span lang="cy">Hoff g&acirc;n Cyrff:</span></strong>&nbsp;'.$profileinfo['favesong'].'
			<br>
			<strong>Favorite Cyrff album/<span lang="cy">Hoff albwn Cyrff:</span></strong>&nbsp;'.$profileinfo['favealbum'].'
			<br>
			<strong>Other comments/<span lang="cy">Eraill sywl:</span></strong>&nbsp;'.$profileinfo['comment'].'
			</p>';
		}else{
			$output = '<h1> '.( isset($title)?$$title:'Error') .'</h1>
			<p>This profile doesn\'t exist</p>';
		}
	
	
		return $output;
	}
	
	/*Sets the fan profile id.*/
	function get_profile_id(){
		
		if (isset( $_GET['profileid']) && ($_GET['profileid'] != NULL
		&& $_GET['profileid'] !='' )){
		
			$profile_id = $_GET['profileid'];
		
		}else{
		
			$profile_id = 200000;
		
		}
		
		return $profile_id ;
		
	}

	/*This is query to get fan profile.*/
	function get_profile_query($profileid){
		
		$sql = 'SELECT 
			profileid, name, place, website, email, email_hidden, firstheard,favesong, favealbum, comment
			FROM fan_profile 
			WHERE profileid ='.$profileid;
			
		return $sql;
		
	}
	
	/*Sends an email when the a new profile is submitted.*/
	function submit_email($name,$location, $website, $email, $hideEmailAddress, $heardcyrff , 
	$favesong, $favealbum, $comments){
		
		$to ='"Christine" <ycyrffgroupie@gmail.com>';
		$subject ="Fan profile submitted";
		$html = "<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
<head></head>
		
<body style=\"background-image:url('http://www.ycyrffgroupie.co.uk/images/background5.jpg'); background-color: #800080; width:100%;\">
		
<table>
		
	<tr>
		<td style=\"width:5%;\">
		</td>
		<td style=\"width:93%;\">
		<table>
			<tr>
				<td style=\"width: 25%;\"><p style=\"color: #ffd700;\">Name/<span lang=\"cy\">Enw:</span>&nbsp;</p></td>
				<td style=\"width: 75%;\"><p style=\"color: #ffd700;\">".$name."</p></td>
			</tr>
		<tr>
			<td style=\"width: 25%;\"><p style=\"color: #ffd700;\">Location/<span lang=\"cy\">LLe:</span>&nbsp;</p></td>
			<td style=\"width: 75%;\"><p style=\"color: #ffd700;\">".$location."</p></td>
		</tr>
		<tr>
			<td style=\"width: 25%;\"><p style=\"color: #ffd700;\">Website/<span lang=\"cy\">Gwe safle:</span>&nbsp;</p></td>
			<td style=\"width: 75%;\"><a style=\"color: #ffd700;\" href=\"".$website."\">".$website."</a></td>
		</tr>
		<tr>
			<td style=\"width: 25%;\"><p style=\"color: #ffd700;\">E-mail/<span lang=\"cy\">E-bost:</span>&nbsp;</p></td>
			<td style=\"width: 75%;\"><a style=\"color: #ffd700;\" href=\"mailto:".$email."\">".$email."</p></td>
		</tr>
		<tr>
			<td align=\"center\" colspan=\"2\"><p style=\"color: #ffd700;\">Where did you first heard about Y Cyrff/<span lang=\"cy\"> LLe naethoch chi cyntaf wedi clywed am Y Cyrff?</span></p> <br><p style=\"color: #ffd700;\">".$heardcyrff."</p></td>
		</tr>
		<tr>
			<td colspan=\"2\"><p style=\"color: #ffd700;\">Favourite Cyrff song/<span lang=\"cy\">Hoff g&acirc;n Cyrff:</span>&nbsp;</p></td>
		</tr>
		".($favesong != NULL ? $favesong != ' ' ? '<tr>
			<td colspan="2"><p style="color: #ffd700;">'.$favesong.'</p></td>
		</tr>' : ''  : '' )."
		<tr>
			<td colspan=\"2\"><p style=\"color: #ffd700;\">Favoutite Cyrff album/<span lang=\"cy\">Hoff albwn Cyrff:</span>&nbsp;</p></td>
		</tr>
		".($favealbum != NULL ? $favealbum != ' ' ?  '<tr>
			<td colspan="2"><p style="color: #ffd700;">'.$favealbum.'</p></td>
		</tr>' : '' : '' )."
		<tr>
			<td align=\"center\" colspan=\"2\"><p style=\"color: #ffd700;\">Other comments/<span lang=\"cy\"> Eraill sywl:</span></p> <br><p style=\"color: #ffd700;\">".$comments."</p></td>
	</table>
	</td>
	</tr>
</table>
</body>
</html>";

		$txt = strip_tags(str_replace('&nbsp;',' ',$html));
		
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x".$semi_rand ."x";
		
		$headers ='From: "Webmistress" <webmistress@ycyrffgroupie.co.uk>'."\r\n";
		$headers .='Reply-To: "'.$name.'"<' .$email.'>'."\r\n";
		$headers .='MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: multipart/alternative; boundary='.$mime_boundary."\r\n";
		//$headers .= 'Content-Type: text/html'."\r\n";
		
		$message = 'This is a multi-part message in MIME format.'."\r\n\r\n".
'--'.$mime_boundary."\r\n".
'Content-Type: text/plain; charset="utf-8"'."\r\n".
'Content-Transfer-Encoding:7-bit'."\r\n\r\n".$txt."\r\n".
'--'.$mime_boundary."\r\n".
'Content-Type: text/html; charset="utf-8"'. "\r\n".
'Content-Transfer-Encoding: 7-bit'. "\r\n\r\n".$html."\r\n";

		mail($to,$subject,$message, $headers);
		
	}
	
	/**/
	function submit_form_success($name,$location, $website, $email, $hideEmailAddress, $heardcyrff , $favesong, $favealbum, $comments){
		
		$this ->submit_email($name,$location, $website, $email, $hideEmailAddress, $heardcyrff , $favesong, $favealbum, $comments);
		
		$this ->submit_query($name,$location, $website, $email, $hideEmailAddress, $heardcyrff , $favesong, $favealbum, $comments);
	
		$output = "<p>Thank you, your profile has been submitted. I will add your profile soon so come back to check.</p>
	<p>Diolch i chi, eich proffil wedi ei gyflwyno. Byddaf yn ychwanegu eich proffil fuan er mwyn dod yn &ocirc;l i wirio.</p>";
		
		return $output;
	}
	
	/*This is the query to submit a new fan profile.*/
	function submit_query($name,$location, $website, $email, $hideEmailAddress, $heardcyrff , 
	$favesong, $favealbum, $comments){
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
		$sql= sprintf("INSERT INTO fan_profile ( name, place, website, email, email_hidden, firstheard, favesong, favealbum, comment) 
			VALUES(%s,%s,%s,%s, ".$hideEmailAddress.",%s,%s,%s,%s)",
			$database ->quote($name),
			$database ->quote($location),
			$database ->quote($website),
			$database ->quote($email),
			$database ->quote($heardcyrff),
			$database ->quote($favesong),
			$database ->quote($favealbum),
			$database ->quote($comments));

		$query = $database ->prepare($sql);
		$query ->execute();
		
	}
	
	/**/
	/*function (){
		
		
		
	}*/
	
	
}