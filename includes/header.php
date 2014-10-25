<?php
/*@Author; Christine A. Black
@Version:0.14
@todo: Add menu and fan profile class.

Version 0.14 - Added display_header and get_profile_id methods to the header class.
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

/*Set a new visitor class , sets a new footer class and sets the header class.*/
$visitor = new visitor;
$footer = new footer;
$header = new header;

/*Sets variables.////*/
$filename = $header  ->get_filename();
$profile_id = $header  ->get_profile_id();

/*Displays the header.*/
echo $header  ->display_header();

?>