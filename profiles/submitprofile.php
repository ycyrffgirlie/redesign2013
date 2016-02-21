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
	$hideEmailAddress = $_POST["hideEmailAddress"] == "Yes"? 1: 0;
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


<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<body>

<script src="/includes/javascript/submitProfile.js"></script>

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
		

		echo $fanProfile ->submit_form_success($name,$location, $website, $email, $hideEmailAddress, $heardcyrff , $favesong, $favealbum, $comments);
	
	
}else{
	
	echo $fanProfile ->display_submit_form();

}
?>


<?php echo backButton($filename ); ?>

<?php include '../includes/footer.php'; ?>

</div>



</body>

</html>