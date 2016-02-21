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



?>