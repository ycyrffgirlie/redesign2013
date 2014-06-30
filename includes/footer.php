<div class="clear"></div>

<footer>
	
	<div class="footerLeft">
<?php

error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);

/*@Author; Christine A. Black
@Version:0.2
@todo: comment the rest of the rest of the code, set vars to default 
values, sort out the url params, sort out the debug. 
Version 0.3 - remove the css from this file. 
Version 0.2 - added the visitor.
Version 0.1 - added a footer to the site.
*/

include 'class/visitor.class.php';

//set debugging info
$debug = isset($_GET["debug"])? $_GET["debug"] : '' ;
$browser = isset($_GET["browser"])? $_GET["browser"] : '' ;

//set variables
$browserinfo = get_browser(NULL, true);
$browsername = $browserinfo["browser"];
$browsernversion = $browserinfo["version"];

if ($browserinfo["platform_description"] == 'unknown'){
	$os = $browserinfo["platform"];
}
else{
	$os = $browserinfo["platform_description"];
}

//for debugging

//switch($debug){

//case 'linux':
	
	$_SESSION["os"] = $debug;
	$_SESSION["browsername"] = $browser;
	
	if ($browser == 'Firefox'){
		$_SESSION["browsernversion"] = 3;
	}elseif  ($browser == 'Chrome'){
		$_SESSION["browsernversion"] = 13.0;
	}elseif  ($browser == 'IE'){
		$_SESSION["browsernversion"] = 6;
	}elseif  ($browser == 'Opera'){
		$_SESSION["browsernversion"] = 9;
	}elseif  ($browser == 'Safari'){
		$_SESSION["browsernversion"] = 5.0;
	}
	
	$_SESSION["domainname"] = $_SERVER["HTTP_HOST"];
	$_SESSION["ip_address"]  = $_SERVER["REMOTE_ADDR"];
	$_SESSION["referer_page"]  = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]: 'none';
	$_SESSION["request_page"]  = $_SERVER["REQUEST_URI"];
	$_SESSION["user"] = isset($_SERVER["PHP_AUTH_USER"])?$_SERVER["PHP_AUTH_USER"]: 'none';
	$_SESSION["filename"] = $_SERVER["SCRIPT_FILENAME"];
	$_SESSION["php_self"] = $_SERVER["PHP_SELF"];
	
	//break;

/*default:
	$_SESSION["browsername"] = $browsername;
	$_SESSION["browsernversion"] = $browsernversion;
	$_SESSION["os"] = $os;
	$_SESSION["domainname"] = $_SERVER["HTTP_HOST"];
	$_SESSION["ip_address"]  = $_SERVER["REMOTE_ADDR"];
	$_SESSION["referer_page"]  = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'';
	$_SESSION["request_page"]  = $_SERVER["REQUEST_URI"];
	$_SESSION["user"] = isset($_SERVER["PHP_AUTH_USER"])?$_SERVER["PHP_AUTH_USER"]:
	$_SESSION["filename"] = $_SERVER["SCRIPT_FILENAME"];
	$_SESSION["php_self"] = $_SERVER["PHP_SELF"];
	
	break;*/

//}

$visitor = new visitor;
$visitor ->get_visitor_details($_SESSION["os"], $_SESSION["browsername"], $_SESSION["browsernversion"],
				$_SESSION["domainname"] , $_SESSION["ip_address"] ,
				$_SESSION["referer_page"], $_SESSION["request_page"], 
				$_SESSION["user"], $_SESSION["filename"], $_SESSION["php_self"]);



$domainmanes = array('christine.ycyrffgroupie.co.uk',
		'dev.ycyrffgroupie.co.uk',
		'llwybrllaethog.ycyrffgroupie.co.uk',
		'admin.ycyrffgroupie.co.uk'
		,'redesign2013.ycyrffgroupie.co.uk'
		,'christine.linux.ycyrffgroupie.co.uk'
		,'redesign2013.linux.ycyrffgroupie.co.uk'
		);
	
	?>


		<a href="http://internetdefenseleague.org"><img src="http://internetdefenseleague.org/images/badges/final/footer_badge.png" alt="Member of The Internet Defense League" /></a>

<?php
if (!in_array($_SESSION["domainname"],$domainmanes)){
?>
	<br />
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-1700322885253994";
		/* Ad 1 */
		google_ad_slot = "4964110045";
		google_ad_width = 468;
		google_ad_height = 60;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>

		<a href="http://tracking.opienetwork.com/aff_c?offer_id=20&aff_id=5600&file_id=313" target="_blank"><img src="http://media.go2speed.org/brand/files/opienetwork/20/hp-88x31-green.gif" width="88" height="31" border="0" /></a><img src="http://tracking.opienetwork.com/aff_i?offer_id=20&aff_id=5600&file_id=313" width="1" height="1">
<?php
}
?>

	</div>

	<div class="footerRight">
		<form accept-charset="UTF-8" action="http://www.jrank.org/api/search/v2" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓" /></div>
			<fieldset style="border: 1px solid rgb(175, 175, 175); display: inline;">
				<legend>
					<a href="http://www.jrank.org/" style="font-size: 10pt; font-family: Arial, sans-serif;">
						Site Search
					</a>
				</legend>
				<a href="http://www.jrank.org/">
					<img alt="Site Search" 
					src="http://www.jrank.org/images/jrank_88_31-fs8.png" 
					style="border: none; vertical-align: middle;" title="Site Search" />
				</a>
				<input id="key" name="key" type="hidden" value="827b2c24d923ca553b508bc1160538c4c164a2c4" />
				<input name="ie_utf8_fix" type="hidden" value="☠" />
				<input id="q" name="q" style="display: inline; vertical-align: middle;" type="text" value="" />
				<input name="commit" style="display: inline; vertical-align: middle;" type="submit" value="Search" />
			</fieldset>
		</form>
	
	</div>

	<div style="clear:both;"></div>


<?php

$visitor ->os_check();

if (in_array($_SESSION["domainname"],$domainmanes)){

	if ($_SESSION["ip_address"]  == '188.223.77.182'){
		$message = "
<p>Welcome ".$_SESSION["user"].", this is not live. 
<br>";

	}else{
	
	$message = "<p>Welcome ".$_SESSION["user"].", this is not live. 
<br>";
	}

}else{
	if ($_SESSION["ip_address"] == '188.223.77.182'){
	$message = "<p>Welcome ".$_SESSION["ip_address"].", please remember that this is live. So please don't fuck it up. 
	<br>Script Name ".$_SESSION["filename"]."
<br>";
	}
	
	
}

if ($message){
	$visitor ->visitor_display($message);
}
?>
</footer>

<?php

/*if ($_SESSION["browsername"] == "Chrome"){
	//echo "your are using chrome";
	if  ($_SESSION["browsernversion"] == 0){
		$to = 'ycyrffgroupie@gmail.com';
		$subject = 'Update browsercap';
		$message = '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>
	<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\'); background-color: #800080; width:100%;" link="ffd700" alink="ffd700" >
		<table>
			<tr>
				<td style="width:5%">&nbsp;</td>
				<td style="width:93%">
					<p><font color="ffd700">Site\'s broken. You need to update browsercap.</font></p>
					<p><font color="ffd700">'.$_SERVER["REMOTE_ADDR"].' has just requested 
					<a style="color: #ffd700;" href="'.$_SERVER["HTTP_HOST"].'/'.$_SERVER["REQUEST_URI"].'">
					this page</a> using '.$browsername.'. The script couldn\'t detect the browser version.';
			if ($_SERVER["HTTP_REFERER"] != NULL && $_SERVER["HTTP_REFERER"] != ' '){
			
		$message .= 'The refering url is: 
					<a style="color: #ffd700;" href="' .$_SERVER["HTTP_REFERER"].'">'.$_SERVER["HTTP_REFERER"].'</a></font></p>';
			}
		
		$message .='
					<br>
					<br>
					<p><font color="ffd700">Thanks,
					<br>
					One nutty fan.</font></p>
				</td>
			</tr>
		</table>
	</body>';
		$headers ='MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: text/html; charset=\"utf-8\"'. "\r\n";
		$headers .='From:  "Webmistress" <webmistress@ycyrffgroupie.co.uk>'. "\r\n";			
		mail($to,$subject,$message, $headers);
	}
		
}*.
?>




</div>