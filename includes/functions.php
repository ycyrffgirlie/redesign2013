<?php

function backButton($filename){

	$link = substr_replace($filename, ' ', strrpos($filename, "/"));
	//$output = '<p>'.$link.'</p>';
	$link  = trim($link );
	
	if ($filename == "/profiles/fanprofile.php"){
		$internalURL = array ('http://'.$_SERVER["HTTP_HOST" ].$link.'/profile.html');
		$link  = 'http://'.$_SERVER["HTTP_HOST" ].$link.'/profile.html';
	}else{
		$internalURL = array ('http://'.$_SERVER["HTTP_HOST"].$link , 
		'http://'.$_SERVER["HTTP_HOST"].$link.'/' , 
		'http://'.$_SERVER["HTTP_HOST"].$link .'/index.html');
		//$output = '<p class="internalURL">'.print_r($internalURL).'</p>';
	}
	if (in_array($_SERVER["HTTP_REFERER"],$internalURL)){
		$output = '<script>
$(document).ready(function(){
	$(\'div[class="back"]\').click(function(){
		history.back();
		return false;
	});
});
 
</script>
<div class="back">
	<span class="button">
		Back / Yn &ocirc;l
	</span>
</div>';

	}else{
		$output = '<a href="'.$link .'"class="buttonlink"><div class="back">
	<span class="button">
		Back / Yn &ocirc;l
	</span>
</div></a>';
	}
	
	return $output;
}

function getprofile($profileid){
	if (file_exists('/includes/connection.php')){
	require('includes/connection.php');
}else{
	require("connection.php");
}

	$sql = 'SELECT 
			profileid, name, place, website, email, firstheard,favesong, favealbum, comment
			FROM fan_profile 
			WHERE profileid ='.$profileid;
	$query = mysql_query($sql);
	$profileinfo = mysql_fetch_assoc($query);
	
	if ($profileinfo){
	$output = '<p><strong>Name/Enw:</strong>&nbsp;'.$profileinfo['name'].'
			<br>
			<strong>Location/<span lang="cy">LLe:</span></strong>&nbsp;'.$profileinfo['place'].'
			<br>
			<strong>Website/<span lang="cy">Gwe safle:</span></strong>&nbsp;'.$profileinfo['website'].'
			<br>
			<strong>E-mail/<span lang="cy">E-bost:</span></strong>&nbsp;'.$profileinfo['email'].'
			<br>
			<strong>Where first heard about Cyrff?/<span lang="cy">LLe naethoch chi cyntaf wedi clywed am Y Cyrff?</span></strong>&nbsp;'.$profileinfo['firstheard'].'
			<br>
			<strong>Favourite Cyrff song/<span lang="cy">Hoff g&acirc;n Cyrff:</span></strong>&nbsp;'.$profileinfo['favesong'].'
			<br>
			<strong>Favorite Cyrff album/<span lang="cy">Hoff albwn Cyrff:</span></strong>&nbsp;'.$profileinfo['favealbum'].'
			<br>
			<strong>Other comments/<span lang="cy">Eraill sywl:</span></strong>&nbsp;'.$profileinfo['comment'].'
			</p>';
		}else{
			$output = '<p>This profile doesn\'t exist</p>';
		}
	
	mysql_close($connection);
	return $output;
}

?>