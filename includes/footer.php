<style>

</style>

<div class="clear"></div>

<footer>
	
	<div class="footerLeft">
<?php

//set variables
$browserinfo = get_browser(NULL, true);
//print_r($browserinfo);
$browsername = $browserinfo["browser"];
$browsernversion = $browserinfo["version"];

if ($browserinfo["platform_description"] == 'unknown'){
	$os = $browserinfo["platform"];
}
else{
	$os = $browserinfo["platform_description"];
}

$_SESSION["domainname"] = $_SERVER["HTTP_HOST"];
$_SESSION["browsername"] = $browsername;
$_SESSION["browsernversion"] = $browsernversion;
$_SESSION["os"] = $os;
$_SESSION["ip_address"]  = $_SERVER["REMOTE_ADDR"];
$_SESSION["referer_page"]  = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'';
$_SESSION["request_page"]  = $_SERVER["REQUEST_URI"];
$_SESSION["user"] = $_SERVER["PHP_AUTH_USER"];
$_SESSION["filename"] = $_SERVER["SCRIPT_FILENAME"];
$_SESSION["php_self"] = $_SERVER["PHP_SELF"];
//$_SESSION[""] 

//print_r($_SESSION);
//die();

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
<br>
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
	<legend><a href="http://www.jrank.org/" style="font-size: 10pt; font-family: Arial, sans-serif;">Site Search</a></legend>
	<a href="http://www.jrank.org/"><img alt="Site Search" src="http://www.jrank.org/images/jrank_88_31-fs8.png" style="border: none; vertical-align: middle;" title="Site Search" /></a>
	<input id="key" name="key" type="hidden" value="827b2c24d923ca553b508bc1160538c4c164a2c4" />
	<input name="ie_utf8_fix" type="hidden" value="☠" />
	<input id="q" name="q" style="display: inline; vertical-align: middle;" type="text" value="" />
	<input name="commit" style="display: inline; vertical-align: middle;" type="submit" value="Search" />
	</fieldset>
	</form>

</div>

<div style="clear:both;">


<?php
if (in_array($_SESSION["domainname"],$domainmanes)){

	if ($_SESSION["ip_address"]  == '188.223.77.182'){
		echo "
<p>Welcome ".$_SESSION["user"].", this is not live. 
<br>
Script Name ".$_SESSION["filename"]."
<br>
Php_self: ".$_SESSION["php_self"]."
<br>
Your Os: ".$_SESSION["os"]." and you are using: ".$_SESSION["browsername"]." ".$_SESSION["browsernversion"].". 
<br>
Your ISP is: ".$_SESSION["ip_address"] .". 
<br>
You have come from: ".$_SESSION["referer_page"].".
<br>
This 
footer is for your information.</p>";

	}else{
	
	echo "<p>Welcome ".$_SESSION["user"].", this is not live. 
<br>
Script Name ".$_SESSION["filename"]."
<br>
Php_self: ".$_SESSION["php_self"]."
<br>
Your Os: ".$_SESSION["os"] ." and you are using: ".$_SESSION["browsername"]." ".$_SESSION["browsernversion"].". 
<br>
Your ISP is: ".$_SESSION["ip_address"].". 
<br>
You have come from: ".$_SESSION["referer_page"].".
<br>
This 
footer is for your information.</p>";
	}

}
else{
	if ($_SESSION["ip_address"] == '188.223.77.182'){
	echo "<p>Welcome ".$_SESSION["ip_address"].", please remember that this is live. So please don't fuck it up. 
	<br>Script Name ".$_SESSION["filename"]."
<br>
Php_self: ".$_SESSION["php_self"]."
<br>
Your Os: ".$_SESSION["os"]." and you are using: ".$_SESSION["browsername"]." ".$_SESSION["browsernversion"].". 
<br>
Your ISP is: ".$_SESSION["ip_address"].". 
<br>
You have come from: ".$_SESSION["referer_page"].".
<br>
This 
footer is for your information.</p>";	
	}
}
?>
</footer>

<?php if ($_SESSION["browsername"] == "Chrome"){
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
	}elseif ($browsernversion <= 15.0){
		echo "<p>This site doesn't support your version of Chrome. Please update your browser</p>
		<p>Nid we safle hwn yn cefnogi eich fersiwn o Chrome. Diweddarwch eich porwr.</p>";
		if ($os == 'Windows Vista' || $os == 'Windows XP' || $os == 'Windows 7'){
	?>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php	
	}
		if ($os == 'Windows 98' || $os =='Windows 95'  || $os== 'Windows 2000' || $os =='Windows ME'){
		echo "<p>Chrome doesn't support Windows Me, Windows 2000, Windows 98, Windows 95.<!--If you need to use a version of Windows that pre-dates Windows Xp then chosse from the alternative browsers-->.</p>";
		?>
		<!--<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		</p>-->
<?php
		}
		if($os == 'Linux' ){
		?>
		<p>Please check your distros lastest repository branch first.</p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		If you must destroy a beautiful OS with I.E then -<a class="normal" href="" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php
		
		}
		if($os == 'Mac'){
		?>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php
		}
	}
		
}

if ($browsername == 'IE' || $browsername == "MSIE"){
	//echo "your are using ie";
	if ($browsernversion <= 7){
		echo "<p>This site doen't support your version of Internet Explorer. Please update your browser</p>";
		if ($os == 'Windows Vista' || $os == 'Windows XP' || $os == 'Windows 7'){
	?>
		<a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
		
		<p>Please note: If you are using IE under Wine on a Linux - the script will detect Windows instead of Linux.</p>
<?php	
		}
		if ($os == 'Windows 98' || $os =='Windows 95'  || $os== 'Windows 2000' || $os =='Windows ME'){
		echo "<p>Internet Explorer doesn't support Windows Me, Windows 2000, Windows 98, Windows 95<!--If you need to use a version of Windows that pre-dates Windows Xp then chosse from the alternative browsers-->.</p>";
		?>
		<!--<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		</p>-->
<?php	
		}
		if($os == 'Linux' ){
		echo "<p>Microsoft has stop supporting IE on Linux. Please use alternative browsers.</p>";
		
	?>
		<p>Please check your distros lastest repository branch first.</p>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php	
		}
		if($os == 'Mac' ){
		echo "<p>Microsoft has stop supporting IE on Mac. Please use alternative browsers.</p>";
	?>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>

<?php	
		}
	}
		
}

if ($browsername == "Firefox"){
	//echo "you are using Firefox";
	if ($browsernversion <= 5){
		echo "<p>This site doen't support your version of Firefox. Please update your browser</p>";
		if ($os == 'Windows Vista' || $os == 'Windows XP' || $os == 'Windows 7'){
	?>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>

<?php	
		}		
		if ($os == 'Windows 98' || $os =='Windows 95'  || $os== 'Windows 2000' || $os =='Windows ME'){
		//echo "You are running Firefox on 98.";
		echo "<p>Firefox doesn't support Windows Me, Windows 2000, Windows 98, Windows 95.<!--If you need to use a version of Windows that pre-dates Windows Xp then chosse from the alternative browsers-->.</p>";
		?>
		<!--<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		</p>-->
<?php		
		}
		if($os == 'Linux' ){
	?>
		<p>Please check your distros lastest repository branch first.</p>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<p>Alternative Browsers  / Porwyr arall</p>
		<p>
		If you must destroy a beautiful OS with I.E then - <a class="normal" href="" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php	
		}
		if($os == 'Mac' ){
	?>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>

<?php	
		}
	}
}

if ($browsername == "Opera"){
	//echo "you are using Opera";
	if ($browsernversion <= 10){
		echo "<p>This site doen't support your version of Opera. Please update your browser</p>";
		if ($os == 'Windows Vista' || $os == 'Windows XP' || $os == 'Windows 7'){
	?>
		
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php	
		}
		if ($os == 'Windows 98' || $os =='Windows 95'  || $os== 'Windows 2000' || $os =='Windows ME'){
		echo "<p>Chrome doesn't support Windows Me, Windows 2000, Windows 98, Windows 95. <!--If you need to use a version of Windows that pre-dates Windows Xp then chosse from the alternative browsers-->.</p>";
		?>
		<!--<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		</p>-->
<?php		
		}
		if($os == 'Linux' ){
	?>
		<p>Please check your distros lastest repository branch first.</p>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		If you must destroy a beautiful OS with I.E then - <a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a> 
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php	
		}
		if($os == 'Mac' ){
	?>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		</p>
<?php	
		}
	}

}

if ($browsername =="Safari"){
	if ($browsernversion <= 5.2){
		echo "<p>This site doen't support your version of Safari. Please update your browser</p>";
		if ($os == 'Windows Vista' || $os == 'Windows XP' || $os == 'Windows 7'){
		?>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		</p>
<?php
		}
		if ($os == 'Windows 98' || $os =='Windows 95'  || $os== 'Windows 2000' || $os =='Windows ME'){
		echo "<p>Apple doesn't support Windows Me, Windows 2000, Windows 98, Windows 95.<!--If you need to use a version of Windows that pre-dates Windows Xp then chosse from the alternative browsers-->.</p>";
		?>
		<!--<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="" target="">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		</p>-->
<?php
		}
		if($os == 'Linux' ){
		echo "<p>How did you get Safari on Linux? Apple doesn't support. I thought the saying is \"Can I get Linux run on this?\" 
		not \"will Safari run on Linux? \" Seeing you are a smart arse I am not getting you the link for Safari for Linux.";
		echo "</p>";
		?>
		<p>Please check your distros lastest repository branch first.</p>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a> 
		<p>If you must destroy a beautiful OS with I.E then</p>
		<a class="normal" href="" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/ie.gif" alt="Internet Explorer">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox"></a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera"></a>
		</p>
<?php
		}
		if($os == 'Mac'){
		?>
		<a class="normal" href="http://www.apple.com/safari/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/safari.gif" alt="Safari"> </a>
		<p>Alternative Browsers / Porwyr arall</p>
		<p>
		<a class="normal" href="http://www.google.com/chrome/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/chrome.gif" alt="Chrome">
		</a>
		<a class="normal" href="http://www.mozilla.org/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/firefox.gif" alt="Firefox">
		</a>
		<a class="normal" href="http://www.opera.com/" target="_blank">
		<img src="http://www.ycyrffgroupie.co.uk/Images/site/opera.gif" alt="Opera">
		</a>
		</p>
<?php
		}
	}
}


?>




</div>