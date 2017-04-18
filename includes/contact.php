<?php
/*@Author; Christine A. Black
@Version:0.1
@todo: 

Version 0.1 - Added the contact  form  to the site. */

/*error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);*/
if (!isset($_SESSION)){
	session_name('cyrffRedesign');
	session_start();
}

if (isset($_POST["name"] )){
	if ($_POST["name"] !=NULL && $_POST["name"] != ' ' &&  $_POST["email"]  != NULL && $_POST["email"] != ' ' ){
		$name = $_POST["name"];
		$website = $_POST["website"];
		$email = $_POST["email"];
		$message = $_POST["message"];
		$_GET["v"] = '';
	}else{
		$_SESSION["contactName"] = $_POST["name"];
		$_SESSION["contactWebsite"] = $_POST["website"];
		$_SESSION["conactEmail"] = $_POST["email"];
		$_SESSION["conactMessage"] = $_POST["message"];
		header('Location:http://'.$_SERVER["HTTP_HOST"].$filename.'?v=fail', true, 302);
		exit ();
	}
	
}

include 'class/contact.class.php';
$contact = new contact;

?>
<script src="/includes/javascript/contact.js"></script>
<?php 

//echo '<p>'.$filename.'</p>';

if (isset($_POST["name"]) &&  $_GET["v"] != 'fail'){
	
	echo $contact ->contact_form_success($name,$website,$email,$message,$filename);
	
}else{

	echo  $contact ->display_contact_form($filename);

}
?>