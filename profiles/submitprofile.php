<?php 
/*error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);*/
if (!isset($_SESSION)){
	session_name('cyrffRedesign');
	session_start();
}

if (isset($_POST["name"] )){
if ($_POST["name"] !=NULL && $_POST["name"] != ' ' &&  $_POST["email"]  != NULL && $_POST["email"] != ' ' ){

	$name = $_POST["name"];
	$location = $_POST["location"];
	$website = $_POST["website"];
	$email = $_POST["email"];
	$heardcyrff = $_POST["heardcyrff"];
	$favesong = $_POST["favesong"];
	$favealbum = $_POST["favealbum"];
	$comments = $_POST["comments"];
	$_GET["v"] = '';
	

}else{
	$_SESSION["profileName"] = $_POST["name"];
	$_SESSION["profileLocation"] = $_POST["location"];
	$_SESSION["profilWebsite"] = $_POST["website"];
	$_SESSION["profileEmail"] = $_POST["email"];
	$_SESSION["profileHeardcyrff"] = $_POST["heardcyrff"];
	$_SESSION["profileFavesong"] = $_POST["favesong"];
	$_SESSION["profileFavealbum"] = $_POST["favealbum"];
	$_SESSION["profileComments"] = $_POST["comments"];
	header('Location:http://'.$_SERVER["HTTP_HOST"].'/profiles/submitprofile.php?v=fail', true, 302);
	exit ();
}
}

if (isset($_GET["v"])){
	/*if ($_GET["v"] == 'fail'){
		//print_r($_SESSION);
	}*/

}

include '../includes/header.php'; ?>


<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include '../includes/menu.html';?>
	</ul>
</div>

<h1>Submit a Profile/<span lang="cy">Anfon proffeil</span></h1>

<?php
	if (isset($_POST["name"]) &&  $_GET["v"] != 'fail'){
	//if ($_POST["name"] !=NULL && $_POST["name"] != ' ' &&  $_POST["email"]  != NULL && $_POST["email"] != ' ' ){
		

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
		
		require('/home/ycyrf718/public_html/redesign2013/includes/connection.php');
		
		$sql= sprintf("INSERT INTO fan_profile ( name, place, website, email, firstheard, favesong, favealbum, comment) 
			VALUES('%s','%s','%s','%s','%s','%s','%s','%s')",
			mysql_real_escape_string($name),
			mysql_real_escape_string($location),
			mysql_real_escape_string($website),
			mysql_real_escape_string($email),
			mysql_real_escape_string($heardcyrff),
			mysql_real_escape_string($favesong),
			mysql_real_escape_string($favealbum),
			mysql_real_escape_string($comments));

		mysql_query($sql);
	
	//echo "<p>".$sql."</p>";
		echo "<p>Thank you, your profile has been submitted. I will add your profile soon so come back to check.</p>
	<p>Diolch i chi, eich proffil wedi ei gyflwyno. Byddaf yn ychwanegu eich proffil fuan er mwyn dod yn &ocirc;l i wirio.</p>";
	
	
}else{
	
echo "<style>
.fieldline{
	/*border: 2px solid #FFFFFF;*/
	min-height: 50px;
	padding: 5px;
}
.fieldname{
	float: left;
	padding: 0;
	width: 150px;
	min-height: 35px;
}

.field{
	float: left;
	width: 250px;
}

.white{
	color: #ffffff;
}

#error{
	display:none;
}

</style>

<script>
$('document').ready(function(){
	$('div#error').hide();
	
	$('#profileForm').submit(function(){
		var name = $('input[name=\"name\"]').val();
		var email = $('input[name=\"email\"]').val();
		var atPosition = email.indexOf('@');
		var dotPosition= email.lastIndexOf('.'); 
		var error = 0;
		
		if (name == 'null' || name.length == 0){
			if (error == 0){
				$('input[name=\"name\"]').focus();
			}
			error = error + 1;
		}
		
		if (email == 'null' || email.length == 0){
			if (error == 0){
				$('input[name=\"email\"]').focus();
			}
			error = error + 1;
		}
		
		if (atPosition <1 || dotPosition<atPosition+2 || dotPosition+2>=email.length){
			if (error == 0){
				$('input[name=\"email\"]').focus();
			}
			error = error + 1;
		}
		
		if (error == 0){
			return true;
		}else{
			$('div#error').show();
			alert(\"Please check that you have enter your name and email address correctly. \\n Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad e-bost yn gywir.\");
			return false;
		}
		
	})

});
</script>

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
		<div class=\"fieldname\" style=\"width: 250px;\"><p>Do you wish for your email address to be hidden?</p></div>
		<div class=\"field\" style=\"width: 150px;\"><p><input></p></div>
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
}
?>


<?php echo backButton($filename ); ?>


</div>



</body>

</html>