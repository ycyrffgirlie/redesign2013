<?php
$status = $_SERVER['REDIRECT_STATUS'];
$codes = array(
400 => array( 'Error 400 Bad Request / Gwall 400 - Cais Ddrwg', 'There has been a bad request. ', 'Bu cais drwg.'),
403 => array('403 Forbidden / 403 Mynediad Gwrthod', 'Server configuration does not allow access to this page. '
, 'Nid cyfluniad gweinydd yn caniat&aacute;u mynediad i\'r dudalen hon.'),
404 => array('404 Not Found / 404 Tudalen heb ei darganfod', 'Sorry! The page you requested is unavailable. Please use your browser\'s Back button, or go to the 
  <a class="normal" href="/" target="_self">home page</a> or use the menu at the side to navigate the site.'
  , 'Sori! Mae\'r dudalen y gofynnoch amdani ar gael. Plis defnyddiwch eich  Fotwm Yn &ocirc;l porwr, neu ewch i\'r 
  <a class="normal" href="/" target="_self">dudalen gartref</a> neu defnyddiwch y ddewislen ar yr ochr i lywio o gwmpas y safle we.'),
405 => array('405 Method Not Allowed / 405 Dull Heb a Ganiateir', 'The method specified in the request is not allowed.', 'Nid yw\'r dull a nodir yn y cais yn cael ei ganiat&aacute;u.'),
408 => array('408 Request Timeout / 408 Cais Goramser', 'The server timed out waiting for the request.', 'Mae\'r gweinydd amseru allan aros am y cais.'),
500 => array('500 Internal Server Error / 500 Gwall Gweinydd Mewnol', 'The page cannot be displayed.', 'Ni all y dudalen yn cael ei arddangos.'),
502 => array('502 Bad Gateway / 502 Porth Drwg', 'The server received an invalid response while trying to carry out the request.'
, 'Derbyniodd y gweinydd ymateb annilys wrth geisio i wneud y cais.'),
504 => array('504 Gateway Timeout / Porth Amser-allan', 'The server was acting as a gateway or proxy and did not receive a timely response from the upstream server..'
.'Roedd y gweinydd yn gweithredu fel porth neu ddirprwy ac nid oedd yn cael ymateb prydlon o\'r gweinydd fyny\'r afon.'),
);

$title = $codes[$status][0];
$messageen = $codes[$status][1];
$messagecy = $codes[$status][2];
 
 if ($title == false || strlen($status) != 3) {
	$messageen = 'Please supply a valid HTTP status code.';
	$messagecy = 'Pllis Cyflenwad Cod statws HTTP dilys.';
	
}

include 'includes/class/menu.class.php';

$menu = new menu;
?>
<!DOCTYPE HTML>

<html>
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="/css/style.css?v0.10" /><!--IE couldn't get the style the other way. Don't know why.-->
	<link rel="stylesheet" type="text/css" href="/css/menu.css?v0.1" />
</head>

<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include 'includes/menu.html';?>
	</ul>
</div>

<h1><?php echo $title ?></h1>

<p><?php echo $messageen?>
<br />
<?php echo $messagecy?></p>

<?php if ($status != 404){ ?>

<p>Please use the menu at the side to navigate the site.
<br />
Pl&icirc;s, defnyddiwch y ddewislen ar yr ochr i lywio o gwmpas y safle we.
</p>

<?php }else{?>
<div style="width: 520px;margin: 0px auto;">
	<p>Or visit one of our 5 top pages:
	<br  />Neu ewch i un o'n 5 tudalen top:</p>
	<ul style="list-style: none;">
		<li><a href="/" class="normal">Home page / Tudalen Gartref</a></li>
		<li><a href="/sound_clips/" class="normal">Sound Clips / Swn Ffeiliau</a></li>
		<li><a href="/lyrics/cymrulloegrallanrwst.html" class="normal">Cymru, LLoegr a LLanrwst Lyrics / Geiriau i Gymru, LLoegr a LLanrwst</a></li>
		<li><a href="/lyrics/" class="normal">Lyrics /  Geiriau</a></li>
		<li><a href="/about.html" class="normal">About / Am</a></li>
	</ul>
</div>

<?php } ?>

<div style="width:274px;margin:0px auto;">
	<img src="/images/sorry.gif" alt="Cyrff website/ Cyrff we safle" style="border: #ffd700 1px solid;" width="274" height="104" />
</div>

</div>
</body>


</html>