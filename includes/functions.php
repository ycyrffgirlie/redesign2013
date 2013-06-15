<?php

function backButton($filename){

	$link = substr_replace($filename, ' ', strrpos($filename, "/"));
	//$output = '<p>'.$link.'</p>';
	$link  = trim($link );
	$internalURL = array ('http://'.$_SERVER[HTTP_HOST ].$link , 'http://'.$_SERVER[HTTP_HOST ].$link.'/' , 'http://'.$_SERVER[HTTP_HOST ].$link .'/index.html');
	//$output = '<p class="internalURL">'.print_r($internalURL).'</p>';
	
	if (in_array($_SERVER[HTTP_REFERER],$internalURL)){
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

?>