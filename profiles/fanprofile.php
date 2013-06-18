<?php 
if (file_exists('../includes/connection.php')){
	require('../includes/connection.php');
}else{
	require("connection.php");
}


if (isset( $_GET['profileid']) && ($_GET['profileid'] != NULL && $_GET['profileid'] !='' )){
	$profile_id = $_GET['profileid']; 
	$sql = 'SELECT title FROM pages, fan_profile WHERE pages.filename = fan_profile.filename
	AND profileid = '.$profile_id;

	$query = mysql_query($sql) or die('The error is here');
	if ($query ){
		if ($titlequery = mysql_fetch_assoc($query)){
		//;
			$title = $titlequery["title"];
		}else{
			$title =  'Error:';
		}
	}else{
		$title =  'Error:';
	}
}else{
	$title =  'Error:';
	$profile_id  = 500000;
	//echo 'The else statement';
}

include '../includes/header.php'; ?>

<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include '../includes/menu.html';?>
	</ul>
</div>

<h1><?=$title;?></h1>

<?=getprofile($profile_id);?>



<?php echo backButton($filename ); ?>


</div>



</body>

</html>