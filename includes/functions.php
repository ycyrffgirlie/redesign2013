<?php

function backButton($filename){

	$link = substr_replace($filename, ' ', strrpos($filename, "/"));
	$link  = trim($link );
	
	if ($filename == "/profiles/fanprofile.php"){
		
		$internalURL = array ('http://'.$_SERVER["HTTP_HOST" ].$link.'/profile.html');
		$link  = 'http://'.$_SERVER["HTTP_HOST" ].$link.'/profile.html';
		$referer = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]: '';
		
	}elseif ( $filename == '/albums.html' OR $filename == "/compilations.html" OR $filename == '/singles.html'){
		
		$internalURL = array ('http://'.$_SERVER["HTTP_HOST" ].'/discography.html');
		$link  = 'http://'.$_SERVER["HTTP_HOST" ].'/discography.html';
		$referer = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]: '';
		
	}else{
		
		$internalURL = array ('http://'.$_SERVER["HTTP_HOST"].$link , 
		'http://'.$_SERVER["HTTP_HOST"].$link.'/' , 
		'http://'.$_SERVER["HTTP_HOST"].$link .'/index.html');
		$referer = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]: '';
		
	}
	
	
	if (in_array($referer,$internalURL)){
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
		$output = '<a href="'.$link .'" class="buttonlink"><div class="back">
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
			profileid, name, place, website, email, email_hidden, firstheard,favesong, favealbum, comment
			FROM fan_profile 
			WHERE profileid ='.$profileid;
	
	$query = $database ->prepare($sql);
	$query ->execute();
	
	$profileinfo = $query ->fetch();
	
	if ($profileinfo){
	//print_r($profileinfo);
	$output = '<p><strong>Name/Enw:</strong>&nbsp;'.$profileinfo['name'].'
			<br>
			<strong>Location/<span lang="cy">LLe:</span></strong>&nbsp;'.$profileinfo['place'].'
			<br>
			<strong>Website/<span lang="cy">Gwe safle:</span></strong>&nbsp;'.($profileinfo["email_hidden"] == 0?$profileinfo['website']:'').'
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
	
	
	return $output;
}

?>