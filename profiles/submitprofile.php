<?php include '../includes/header.php'; ?>

<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include '../includes/menu.html';?>
	</ul>
</div>

<H1>Submit a Profile/<span lang="cy">Anfon proffeil</span></H1>

<br>
<br>

<?php
	if (isset($_POST["name"])){
	$name = $_POST["name"];
	$location = $_POST["location"];
	$website = $_POST["website"];
	$email = $_POST["email"];
	$heardcyrff = $_POST["heardcyrff"];
	$favesong = $_POST["favesong"];
	$favealbum = $_POST["favesong"];
	$comments = $_POST["comments"];

	$to ="ycyrffgroupie@gmail.com";
	$subject ="Fan profile submitted";
	$message = "<table style=\"Background-color: #800080;\">
	<tr>
		<td style=\"width: 50%;text-align:right\"><p style=\"color: #ffd700;\">Name/<span lang=\"cy\">Enw:</span>&nbsp;</p></td>
		<td style=\"width: 50%;text-align:left\"><p style=\"color: #ffd700;\">".$name."</p></td>
	</tr>
	<tr>
		<td style=\"width: 50%;text-align:right\"><p style=\"color: #ffd700;\">Location/<span lang=\"cy\">LLe:</span>&nbsp;</p></td>
		<td style=\"width: 50%;text-align:left\"><p style=\"color: #ffd700;\">".$location."</p></td>
	</tr>
	<tr>
		<td style=\"width: 50%;text-align:right\"><p style=\"color: #ffd700;\">Website/<span lang=\"cy\">Gwe safle:</span>&nbsp;</p></td>
		<td style=\"width: 50%;text-align:left\"><a style=\"color: #ffd700;\" href=\"".$website."\">".$website."</a></td>
	</tr>
	<tr>
		<td style=\"width: 50%;text-align:right\"><p style=\"color: #ffd700;\">E-mail/<span lang=\"cy\">E-bost:</span>&nbsp;</p></td>
		<td style=\"width: 50%;text-align:left\"><a style=\"color: #ffd700;\" href=\"mailto:".$email."\">".$email."</p></td>
	</tr>
	<tr>
		<td align=\"center\" colspan=\"2\"><p style=\"color: #ffd700;\">Where did you first heard about Y Cyrff/<span lang=\"cy\"> LLe naethoch chi cyntaf wedi clywed am Y Cyrff?</span></p> <br><p style=\"color: #ffd700;\">".$heardcyrff."</p></td>
	</tr>
	<tr>
		<td style=\"width: 50%;text-align:right\"><p style=\"color: #ffd700;\">Favourite Cyrff song/<span lang=\"cy\">Hoff g&acirc;n Cyrff:</span>&nbsp;</p></td>
		<td style=\"width: 50%;text-align:left\"><p style=\"color: #ffd700;\">".$favesong."</p></td>
	</tr>
	<tr>
		<td style=\"width: 50%;text-align:right\"><p style=\"color: #ffd700;\">Favoutite Cyrff album/<span lang=\"cy\">Hoff albwn Cyrff:</span>&nbsp;</p></td>
		<td style=\"width: 50%;text-align:left\"><p style=\"color: #ffd700;\">".$favealbum."</p></td>
	</tr>
	<tr>
		<td align=\"center\" colspan=\"2\"><p style=\"color: #ffd700;\">Other comments/<span lang=\"cy\"> Eraill sywl:</span></p> <br><p style=\"color: #ffd700;\">".$comments."</p></td>
</table>";
	
	$headers ='MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-Type: text/html; charset=\"utf-8\"'. "\r\n";
	$headers .='From: '.$email."\r\n";

	mail($to,$subject,$message, $headers);
	echo "<p>Thank you, your profile has been submitted. I will add your profile soon so come back to check.</p>
		<p>Diolch i chi, eich proffil wedi ei gyflwyno. Byddaf yn ychwanegu eich proffil fuan er mwyn dod yn &ocirc;l i wirio.</p>";
	}
	else{
	
	
	
echo"<style>


.fieldline{
	/*border: 2px solid #FFFFFF;*/
	min-height: 50px;
	padding: 5px;
}
.fieldname{
	float: left;
	padding: 0;
	width: 250px;
	min-height: 35px;
}

.field{
	float: right;
	width: 250px;
}

.clear{
	clear:both;
}
</style>

<form onSubmit=\"return submitIt(this)\" name=\"profileForm\" method=\"post\" action=\"submitprofile.php\">
<div id=\"content\">
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Name/<span lang=\"cy\">Enw:</span>&nbsp;</p></div>
		<div class=\"field\"><p><input type=\"text\" size=\"20\" name=\"name\"></p></div>
	</div>
	<div class=\"clear\">
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Location/<span lang=\"cy\">LLe:</span>&nbsp;</p></div>
		<div class=\"field\"><p><input type=\"text\" size=\"20\" name=\"location\"></p></div>
	</div>
	<div class=\"clear\">
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Website/<span lang=\"cy\">Gwe safle:</span>&nbsp;</p></div>
		<div class=\"field\"><p><input type=\"text\" size=\"20\" name=\"website\"></p></div>
	</div>
	<div class=\"clear\">
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>E-mail/<span lang=\"cy\">E-bost:</span>&nbsp;</p></div>
		<div class=\"field\"><p><input type=\"text\" size=\"20\" name=\"email\"></p></div>
	</div>
	<div>
		<div align=\"center\" colspan=\"2\">
			<p>Where did you first heard about Y Cyrff/<span lang=\"cy\"> LLe naethoch chi cyntaf wedi clywed am Y Cyrff?</span></p> 
			<br><textarea cols=\"20\" rows=\"5\" name=\"heardcyrff\"></textarea>
		</div>
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Favourite Cyrff song/<span lang=\"cy\">Hoff g&acirc;n Cyrff:</span>&nbsp;</p></div>
		<div class=\"field\"><p><input type=\"text\" size=\"20\" name=\"favesong\"></p></div>
	</div>
	<div class=\"clear\">
	</div>
	<div class=\"fieldline\">
		<div class=\"fieldname\"><p>Favoutite Cyrff album/<span lang=\"cy\">Hoff albwn Cyrff:</span>&nbsp;</p></div>
		<div class=\"field\"><p><input type=\"text\" size=\"20\" name=\"favealbum\"></p></div>
	</div>
	<div>
		<div align=\"center\" colspan=\"2\">
			<p>Other comments/<span lang=\"cy\"> Eraill sywl:</span></p>
			<br><textarea cols=\"20\" rows=\"5\" name=\"comments\"></textarea>
		</div>
	</div>

	<br>
	<br>

	<div style=\"margin:0px auto; width:130px;\">
		<input type=\"submit\" name=\"submit\" value=\"submit\"><input type=\"reset\" name=\"reset\" value=\"reset\">
	</div>

</div>
</form>";
};
?>


<?php echo backButton($filename ); ?>


</div>



</body>

</html>