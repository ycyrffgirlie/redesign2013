<?php

error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);

/*@Author; Christine A. Black
@Version:0.14
@todo: test . 

Version 0.14 - Fixed a php error.
Version 0.13 - Tested MSIE and unknown.
Version 0.12 - Commented rest of code.
Version 0.11 - Created the footer class.
Version 0.10 - Removed the css from this file
Version 0.9 - Remsoved commented out code from this file, Added some more css to this file, 
Added a test to see if not debugging.
Version 0.8 - Initialise the class in another file.
Version 0.7 - Remove debug, domainName_check, error, initialise_session_vars, 
ip_address_check functions.
Version 0.6 - comment the rest of the code
Version 0.5 - created functions debug, domainName_check, error,, initialise_session_vars, ip_address_check.
Version 0.4 - sorted out the url params, sort out the debug set vars to default values.
Version 0.3 - remove the css from this file. 
Version 0.2 - added the visitor.
Version 0.1 - added a footer to the site.
*/

/*Displays the spacing between rhe content and the footer, The footer top. */
echo $footer -> spacing();
echo $footer -> build_footer_top();

/*Set debugging info.*/
$debug = isset($_GET["debug"])? $_GET["debug"] : 'false' ;
$os = isset($_GET["os"])? $_GET["os"] : 'Linux' ;
$browsername = isset($_GET["browser"])? $_GET["browser"] : 'Firefox' ;
$browserversion = isset($_GET["version"])? $_GET["version"] : '0';

/*Check to see if the script is running in debug mode.*/
if ($debug == 'false'){
	/*Sets variables*/
	$browserinfo = get_browser(NULL, true);
	$browsername = $browserinfo["browser"];
	$browserversion = $browserinfo["version"];
	$browserinfo["platform_description"]  = isset($browserinfo["platform_description"])?$browserinfo["platform_description"]: 'unknown';

	/*Sets the os as platform description is sometimes unknown.*/
	if ($browserinfo["platform_description"] == 'unknown'){
		$os = $browserinfo["platform"];
	}
	else{
		$os = $browserinfo["platform_description"];
	}
}

/*Gets debug info.*/
$debug = $visitor ->debug($debug, $os, $browsername, $browserversion);

/*Gets visitors details.*/
$visitor ->get_visitor_details($_SESSION["os"], $_SESSION["browsername"], $_SESSION["browsernversion"],
				$_SESSION["domainname"] , $_SESSION["ip_address"] ,
				$_SESSION["referer_page"], $_SESSION["request_page"], 
				$_SESSION["user"], $_SESSION["filename"], $_SESSION["php_self"]);

/*Displays the Member of The Internet Defense League badge.*/
echo $footer ->member_badge();

/*Displays Google Ads if live.*/
if ($visitor ->domainName_check($_SESSION["domainname"] != true)){
	
	echo $footer ->google_ads();
	
}

/*Displays the footer right.*/
echo $footer ->footer_right();

/*Checks whether the browser is supported.*/
$visitor ->os_check();

/*Sets a message if it's a develomet site.*/
if ($visitor ->domainName_check($_SESSION["domainname"] == true)){

	if ($visitor ->ip_address_check($_SESSION["ip_address"])  == true){
		$message =$footer ->not_live_message($_SESSION["user"]);

	}else{
	
	$message =$footer ->not_live_message($_SESSION["user"]);
	}

}else{
	if (ip_address_check($_SESSION["ip_address"])  == true){
		$message = $footer ->live_message($_SESSION["ip_address"]);
	}
	
}

/*Displays a message if there is one.*/
if ($message){
	$visitor ->visitor_display($message);
}

/*Displays the footer bottom.*/
echo $footer ->build_footer_bottom();
?>