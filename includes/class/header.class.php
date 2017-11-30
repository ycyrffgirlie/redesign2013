
<?php
/*@Author; Christine A. Black
@Version:0.13
@todo: 

Version 0.13 - Changed the version number of the main style sheet
Version 0.12 - Changed the version number of the main style sheet
Version 0.11 - Changed the version number of the main style sheet
Version 0.10 -  Seprated pages table into two.
Version 0.9 - Changed the version number of the main style sheet
Version 0.8 - Changed the version number of the main style sheet
Version 0.7 - Added  twitter cards.
Version 0.6 -  Added a viewpoint.
Version 0.5 - Changed the version number of the main style sheet
Version 0.4 - Added fan profile class to the site.
Version 0.3 - Fixed php error, Added twitter card, fixed favicon, fixed it for about psge. 
Version 0.2 - Added built_header, default_header, default_query, get_filename, profile_query, start_session
and get_profile_id methods.
Version 0.1 - Added the header class to the site. */

class header{
	
	/*Builds the header based on the file info query.*/
	function built_header($filename = "", $title = "Y Cyrff", $keywords = "Y Cyrff", 
	$descriptionEn = "One of the only website about Y Cyrff.", 
	$descriptionCymraeg = "Un o'r unig we safle am Y Cyrff.", $facebookTitle = "Y Cyrff", 
	$facebookDescription = "One of the only website about Y Cyrff. / Un o'r unig we safle am Y Cyrff.", 
	$twittercard = "summary", $twittersite ="@y_cyrff_girlie", $twittertitle ="", $twitterdescription ="", 
	$twitterimage ="", $htmlCode = ""){
		
		$output = '<!DOCTYPE HTML>

<!--Need to query the database first and get the data from db about the currect page.-->
<!--Now the db has given us the data, we can start making up the tags-->

<html lang="en-gb">

	<head lang="en-gb">
		<title>'.$title.'</title>
		<meta charset="UTF-8" />
		<meta name="keywords" content="'.$keywords.'" />
		<meta name="description" content="'.$descriptionEn.' / '.$descriptionCymraeg.'" />
		<meta name="viewpoint" content="width=device-width, height=device-height, initial-scale=1" />
		<link rel="canonical"  href="http://www.ycyrffgroupie.co.uk'.$filename.'" />
		<!--For facebook-->
		<meta property="og:title" content="'.$facebookTitle.'" />
		<meta property="og:url" content="http://www.ycyrffgroupie.co.uk/'.$filename.'" />
		<meta property="og:site_name" content="Y Cyrff Unofficial site" />
		<meta property="og:description" content="'.$facebookDescription.'" />
		<!--end facebook-->
		<!--For twitter-->
		<meta name= "twitter:card" content="'.$twittercard.'"> 
		<meta name= "twitter:site" content="'.$twittersite.'"> 
		<meta name= "twitter:title" content="'.(isset($twittertitle)?$twittertitle:$facebookTitle).'">
		<meta name= "twitter:description" content="'.(isset($twitterdescription)?$twitterdescription:$facebookDescription).'"> 
		<meta name= "twitter:image" content="'.(isset($twitterimage)?$twitterimage:'http://www.ycyrffrgroupie.co.uk/images/title.JPG').'">
		<!--end twitter-->
		<!--If your really need to know-->
		<meta name="author" content="Christine Black" />
		<meta name="generator" content="SCiTE" /> <!--An open soucre producct not shitty Microsoft. Anything they do is a virus. I like a Linux to keep me warm at night-->
		<!--end need to know section-->
		<meta name="rating" content="General" />
		<link rel="shortcut icon" href="/images/icon/cyrff.ico" type="image/x-icon" />
		<link rel="icon" href="/images/icon/cyrff.png" type="image/png" />
		<link rel="stylesheet" type="text/css" href="/css/style.css?v0.13" /><!--IE couldn\'t get the style the other way. Don\'t know why.-->
		<link rel="stylesheet" type="text/css" href="/css/menu.css?v0.1" />';
		
			if (preg_match('.linux.',$_SERVER["HTTP_HOST"])){
			
				$output .= '
		<script src="/includes/javascript/jquery.min.js"></script>
		<script src="/includes/javascript/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/includes/javascript/jquery-ui.css" />';
		
			}else{
		
				$output .= '
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
	
			}

			if  ($htmlCode) {
				
				$output .= $htmlCode;
			
			}
			
			$output .= "
		<script type=\"text/javascript\">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-31457269-1']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>
</head>";

		return $output;
		
	}
	
	/*Builds the default header.*/
	function default_header($filename = ""){
		
		$output = '<!DOCTYPE HTML>
<!--Okay need to use the default.-->
	
	<head lang="en-gb">
		<title>Y Cyrff</title>
		<meta charset="UTF-8" />
		<meta name="keywords" content="Y Cyrff" />
		<meta name="description" content="One of the only website about Y Cyrff. / Un o\'r unig we safle am Y Cyrff." />
		<meta name="viewpoint" content="width=device-width, height=device-height, initial-scale=1" />';
		
		if ($filename == '/about.php'){
		
			$lang = isset($_GET["lang"])? $_GET["lang"]:  'en' ;
			$page = isset($_GET["page"])?  $_GET["page"]: 1 ;
			
			switch($lang){
			  case 'cy':
				
				if ($page == 2){
				
					$link = '/am1.html';
				
				}else{
				
					$link = '/am.html';
				
				}
			  
			  break;
			  
			  case 'en';
			  default:
			  
				if ($page == 2){
				
					$link = '/about1.html';
				
				}else{
				
					$link = '/about.html';
				
				}
			  
			  break;
			
			}
			
			$output .= '
		<link rel="canonical"  href="http://www.ycyrffgroupie.co.uk'.$link.'" />';
			
		}else{
		
			$output .= '
		<link rel="canonical"  href="http://www.ycyrffgroupie.co.uk'.$_SERVER["PHP_SELF"].'" />';
		
		}
		
		$output .= '
		<!--For facebook-->
		<meta property="og:title" content="Y Cyrff" />';
		
		if ($filename == '/about.php'){
		
			$lang = isset($_GET["lang"])? $_GET["lang"]:  'en' ;
			$page = isset($_GET["page"])?  $_GET["page"]: 1 ;
			
			switch($lang){
			  case 'cy':
				
				if ($page == 2){
				
					$link = '/am1.html';
				
				}else{
				
					$link = '/am.html';
				
				}
			  
			  break;
			  
			  case 'en';
			  default:
			  
				if ($page == 2){
				
					$link = '/about1.html';
				
				}else{
				
					$link = '/about.html';
				
				}
			  
			  break;
			
			}
		
			$output .=  '
		<meta property="og:url" content="http://www.ycyrffgroupie.co.uk'.$link.'" />';
		
		
		}else{
		
			$output .=  '
		<meta property="og:url" content="http://www.ycyrffgroupie.co.uk'.$_SERVER["PHP_SELF"].'" />';
		
		}
		
		$output .= '
		<meta property="og:site_name" content="Y Cyrff Unofficial site"  />
		<meta property="og:description" content="One of the only website about Y Cyrff. / Un o\'r unig we safle am Y Cyrff." />
		<!--end facebook-->
		<!--For twitter-->
		<meta name= "twitter:card" content="summary"> 
		<meta name= "twitter:site" content="@y_cyrff_girlie"> 
		<meta name= "twitter:title" content="Y Cyrff">
		<meta name= "twitter:description" content="One of the only website about Y Cyrff. / Un o\'r unig we safle am Y Cyrff."> 
		<meta name= "twitter:image" content="http://www.ycyrffrgroupie.co.uk/images/title.JPG">
		<!--end twitter-->
		<!--If your really need to know-->
		<meta name="author" content="Christine Black" />
		<meta name="generator" content="SCiTE"> <!--An open soucre producct not shitty Microsoft. Anything they do is a virus. I like a Linux to keep me warm at night-->
		<!--end need to know section-->
		<meta name="rating" content="General" />
		<link rel="shortcut icon" href="/images/icon/cyrff.ico"  type="image/x-icon" />
		<link rel="icon" href="/images/icon/cyrff.png" type="image/png" />
		<link rel="stylesheet" type="text/css" href="/css/style.css?v0.13" /><!--IE couldn\'t get the style the other way. Don\'t know why.-->
		<link rel="stylesheet" type="text/css" href="/css/menu.css?v0.1" />';
		
		if (preg_match('.linux.',$_SERVER["HTTP_HOST"])){
			
			$output .= '
		<script src="/includes/javascripts/jquery.min.js"></script>';
		
		}else{
		
			$output .= '
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
	
		}
		
		$output .= '
	</head>';
	
		return $output;
		
	}
	
	/*Sets the default file info query.*/
	function default_query($filename = "/index.html"){
		
		if ($filename == '/about.php'){
		
			$lang = isset($_GET["lang"])? $_GET["lang"]:  'en' ;
			
			switch($lang){
			  case 'cy':
				$page = '/am.html';
				
			  break;
			  
			  case 'en';
			  default:
			  
				$page =  '/about.html';
				
			  break;
			
			}
			  
			$sql = "SELECT pages.filename,title, keywords,descriptionen, descriptioncymraeg, 
			social_media.facebooktitle, social_media.facebookdescription, social_media.facebookimage, 
			social_media.facebookurl, social_media.twittercard, social_media.twittersite, 
			social_media.twittertitle, social_media.twitterdescription, social_media.twitterimage, 
			html5, htmlcode 
			FROM pages , social_media  
			WHERE pages.filename = social_media.filename
			AND pages.filename ='".$page."'";
			

		}else{
		
			$sql = "SELECT pages.filename,title, keywords,descriptionen, descriptioncymraeg, 
			social_media.facebooktitle, social_media.facebookdescription, social_media.facebookimage, 
			social_media.facebookurl, social_media.twittercard, social_media.twittersite, 
			social_media.twittertitle, social_media.twitterdescription, social_media.twitterimage, 
			html5, htmlcode 
			FROM pages , social_media  
			WHERE  pages.filename = social_media.filename
			AND pages.filename ='".$filename."'";
		
		}
		
		return $sql;
		
	}
	
	/**/
	function display_header(){
		
		$filename = $this ->get_filename();
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
		if ($filename == '/profiles/fanprofile.php'){
			
			$fanProfile= new fanProfile;
			
			$profile_id = $fanProfile ->get_profile_id();
			
			if (isset( $profile_id) && ($profile_id != NULL && $profile_id !='' )){
				
				$sql = $this ->profile_query($profile_id);
				  
			 
			}else{
			
				$sql = $this ->default_query($filename);
			}

		}else{
			
			$sql = $this ->default_query($filename);
	
		}
		
		//echo $sql;
		
		$query = $database->prepare($sql);
		$query ->execute();

		$fileinfo = $query->fetch();
		
		$this ->start_session();

		if ($fileinfo){
		
			//print_r($fileinfo);
			//die();
			
			$output = $this -> built_header($fileinfo['filename'], $fileinfo["title"], 
			$fileinfo["keywords"], $fileinfo["descriptionen"], $fileinfo["descriptioncymraeg"], 
			$fileinfo["facebooktitle"],$fileinfo["facebookdescription"], $fileinfo["twittercard"], 
			$fileinfo["twittersite"],$fileinfo["twittertitle"], $fileinfo["twitterdescription"], 
			$fileinfo["twitterimage"], $fileinfo["htmlcode"]);
			
		}else{
			
			$output = $this -> default_header($filename );
			
		}
		
		if ($fileinfo['filename'] == "/includes/header.php"){
			
			$output .= '<body>
						<p>Ha You\'ve found me. How did you manage that?</p>
					</body>
				</html>';
				
		}
		
		$output .= '
<!-- Still reading this. It only gets worse.-->
<!--end being in another file-->';

		return $output;
		
	}
	
	/*Sets the filename.*/
	function get_filename(){
	
		$filename = $_SERVER['SCRIPT_FILENAME'];
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			$filename = preg_replace('%/var/www/websites/redesign2013%', '' , $filename);
		
		}else{
			
			$filename = preg_replace('%/home/ycyrf718/public_html%', '' , $filename);
			
			if (preg_match('%christine%', $filename)){
				$filename = preg_replace('%/christine%','', $filename);
			}elseif(preg_match('%dev%',$filename)){
				$filename = preg_replace('%/dev%','', $filename);
			}elseif (preg_match('%/redesign2013%', $filename)){
				$filename = preg_replace('%/redesign2013%', '', $filename);
			}
		}
		
		return $filename;
		
	}
	
	/*Sets the file info query for fan profle pages.*/
	function profile_query($profileId = 200000){
		
		$sql = 'SELECT pages.filename,title, keywords,descriptionen, 
		descriptioncymraeg,
		social_media.facebooktitle, social_media.facebookdescription, social_media.facebookimage, 
		social_media.facebookurl, social_media.twittercard, social_media.twittersite, 
		social_media.twittertitle, social_media.twitterdescription, social_media.twitterimage, 
		html5, htmlcode
		FROM pages, fan_profile, social_media  
		WHERE pages.filename = social_media.filename
		AND pages.filename = fan_profile.filename
		AND fan_profile.profileid ='.$profileId;
		
		return $sql;
		
	}
	
	/*Starts the session with a name.*/
	function start_session(){
		
		if (preg_match('%christine.ycy%', $_SERVER["HTTP_HOST"])){
	
			session_name('cyrffTest');
			session_start();

		}elseif (preg_match('%redesign2013.ycy%', $_SERVER["HTTP_HOST"]) OR
		preg_match('%redesign2013.lin%', $_SERVER["HTTP_HOST"])
		) {
			if (!isset($_SESSION)){
				
				session_name('cyrffRedesign');
				session_start() or die();
				
			}
		}
		
	}
	
	/**/
	/*function (){
		
		
		
	}*/
}

?>