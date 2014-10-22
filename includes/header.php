<?php
/*@Author; Christine A. Black
@Version:0.13
@todo: 

Version 0.13 - Added the header class to the site.
Version 0.12 - Started a new footer class.
Version 0.11 - Created a footer class.
Version 0.10 - Changed the main stylesheet version number.
Version 0.9 - Added the vistor class and changed the version of the main style sheet.
Version 0.8 - Changed the version of the main style sheet.
Version 0.7 - Updated jquery library. 
Version 0.6 - Changed db connection to PDO and using global vars.
Version 0.5 - Added a check to see if a session has been started.
Version 0.4 - Fixed the mysql error when the fanproile is access without the param.
Version 0.3 - Added jquery.
Version 0.2 - So it works with the subdomain.
Version 0.1 - Added footer to the site, */

global $filename , $profile_id, $fileinfo ;
if (file_exists('/includes/connection.php')){
	require('includes/connection.php');
}else{
	require("connection.php");
}

require_once 'functions.php';
/*the included files.*/
include 'class/visitor.class.php';
include 'class/footer.class.php';
include 'class/header.class.php';

/*Set a new visitor class and sets a new footer class.*/
$visitor = new visitor;
$footer = new footer;
$header = new header;

$filename = $header  ->get_filename();


if ($filename == '/profiles/fanprofile.php'){
	if (isset( $_GET['profileid']) && ($_GET['profileid'] != NULL && $_GET['profileid'] !='' )){
		$profile_id = $_GET['profileid'];
		$sql = 'SELECT pages.filename,title, keywords,descriptionen, descriptioncymraeg, facebooktitle, facebookdescription, 
		facebookimage , facebookurl, html5, htmlcode
		FROM pages, fan_profile
		WHERE pages.filename = fan_profile.filename
		AND fan_profile.profileid ='.$profile_id;
	}else{
		$sql = "SELECT filename,title, keywords,descriptionen, descriptioncymraeg, facebooktitle, facebookdescription, 
		facebookimage , facebookurl, html5, htmlcode FROM pages WHERE filename ='".$filename."'";
	}

}else{
	$sql = "SELECT filename,title, keywords,descriptionen, descriptioncymraeg, facebooktitle, facebookdescription, 
	facebookimage , facebookurl, html5, htmlcode FROM pages WHERE filename ='".$filename."'";
	
}

$query = $database->prepare($sql);
$query ->execute();

$fileinfo = $query->fetch();

if (preg_match('%christine.ycy%', $_SERVER["HTTP_HOST"])){
	
	session_name('cyrffTest');
	session_start();
	
	echo "<p>";
	print_r($fileinfo);
	echo "</p>";

}elseif (preg_match('%redesign2013.ycy%', $_SERVER["HTTP_HOST"])) {
	if (!isset($_SESSION)){
		session_name('cyrffRedesign');
		session_start() or die();
	}
}

if ($fileinfo){
?>
<!DOCTYPE HTML>

<!--Need to query the database first and get the data from db about the currect page.-->
<!--Now the db has given us the data, we can start making up the tags-->

<html lang="en-gb">

<head lang="en-gb">
<title><?=$fileinfo["title"]?></title>
<meta charset="UTF-8" />
<meta name="keywords" content="<?=$fileinfo["keywords"]?>" />
<meta name="description" content="<?=$fileinfo["descriptionen"];?> / <?=$fileinfo["descriptioncymraeg"];?>" />
<link rel="canonical"  href="http://www.ycyrffgroupie.co.uk<?=$fileinfo['filename']?>" />
<!--For facebook-->
<meta property="og:title" content="<?=$fileinfo["facebooktitle"]?>" />
<meta property="og:url" content="http://www.ycyrffgroupie.co.uk<?=$fileinfo['filename']?>" />
<meta property="og:site_name" content="Y Cyrff Unofficial site" />
<meta property="og:description" content="<?=$fileinfo["facebookdescription"]?>" />
<!--end facebook-->
<!--If your really need to know-->
<meta name="author" content="Christine Black" />
<meta name="generator" content="SCiTE" /> <!--An open soucre producct not shitty Microsoft. Anything they do is a virus. I like a Linux to keep me warm at night-->
<!--end need to know section-->
<meta name="rating" content="General" />
<link rel="shortcut icon" href="/images/icon/cyrff.ico">
<link rel="stylesheet" type="text/css" href="/css/style.css?v0.5" /><!--IE couldn't get the style the other way. Don't know why.-->
 <link rel="stylesheet" type="text/css" href="/css/menu.css?v0.1" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <?php
if  ($fileinfo["htmlcode"]) {
echo $fileinfo["htmlcode"];
}
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31457269-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<?php
}else{
?>

<!--Okay need to use the default.-->
<head lang="en-gb">
<title>Y Cyrff</title>
<meta charset="UTF-8" />
<meta name="keywords" content="Y Cyrff" />
<meta name="description" content="One of the only website about Y Cyrff. / Un o'r unig we safle am Y Cyrff." />
<!--For facebook-->
<meta property="og:title" content="Y Cyrff" />
<meta property="og:url" content="http://www.ycyrffgroupie.co.uk<?=$_SERVER["PHP_SELF"]?>" />
<meta property="og:site_name" content="Y Cyrff Unofficial site"  />
<meta property="og:description" content="One of the only website about Y Cyrff. / Un o'r unig we safle am Y Cyrff." />
<!--end facebook-->
<!--If your really need to know-->
<meta name="author" content="Christine Black" />
<meta name="generator" content="SCiTE"> <!--An open soucre producct not shitty Microsoft. Anything they do is a virus. I like a Linux to keep me warm at night-->
<!--end need to know section-->
<meta name="rating" content="General" />
<link rel="shortcut icon" href="/images/icon/cyrff.ico" />
<link rel="stylesheet" type="text/css" href="/css/style.css?v0.5" /><!--IE couldn't get the style the other way. Don't know why.-->
<link rel="stylesheet" type="text/css" href="/css/menu.css?v0.1" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <?php
}
if ($fileinfo['filename'] == "/includes/header.php"){
	echo '<body>
			<p>Ha You\'ve found me. How did you manage that?</p>
		</body>
		</html>';
}

?>
<!-- Still reading this. It only gets worse.-->
<!--end being in another file-->