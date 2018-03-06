<?php
function whatnewen($database){
	$output = '';
	$sql = 'SELECT `filename`, `title`, `whatnewenglish`, `datelastmodified`, `includedinnew`, `newsortorder`FROM `pages` 
	WHERE `includedinnew`= 1
	ORDER BY `newsortorder` DESC';
	$query = $database ->prepare($sql);
	$query ->execute();
	
	if (date('d/m/Y') < strtotime('31 March 2018')){
		//echo date('d/m/Y');
		$output .= '
	<p></p>';
	}
	
	$output .= '
	<p>What is new?
		<br />
		<br />';
	
	while($newenresults = $query ->fetch()){
		$output .= '
		<a class="normal" href="'.$newenresults['filename'].'">'.$newenresults['title'].'</a> - '.$newenresults['whatnewenglish'].'
		<br />';
		
	}
	
	$output .= '
	</p>';

	return $output;
}

function whatnewcy($database){
	$output = '';
	$sql = 'SELECT `filename`, `title`, `whatnewcymraeg`, `datelastmodified`, `includedinnew`, `newsortorder` FROM `pages` 
	WHERE `includedinnew`= 1
	ORDER BY `newsortorder` DESC';
	$query = $database ->prepare($sql);
	$query ->execute();
	
	if (date('d/m/Y') < strtotime('31 March 2018')){
		$output .= '
	<p></p>';
	}
	
	$output = '
	<p>Beth sy newydd
		<br />
		<br />';
	
	while($newenresults = $query ->fetch()){
		$output .= '
		<a class="normal" href="'.$newenresults['filename'].'">'.$newenresults['title'].'</a> - '.$newenresults['whatnewcymraeg'].'
		<br />';
	}
	
	$output .= '
	</p>';
	
	return $output;
}
?>
<style>
#new-container{
    position: fixed;
    background-color: #800080;
    width: 50%;
    left: 23%;
    top: 16%;
    display: none;
    padding: 20px;
    color: #ffd700;
    border: 2px solid #ffd700;
    border-radius: 15px 15px 15px 15px;
    z-index: 21;
}
</style>
<script>
$(document).ready(function(){
	
	$('.new').click(function(event){
		event.preventDefault();
				
		$('body').prepend('<div id="overlay"></div>');
		$('#new-container').show();
	});
	
	$('#new-container > p > .normal').click(function(event){
		$('#overlay').remove();
		$(this).parents('#new-container').hide();
	});
	
	$('#new-container > .close').click(function(event){
		event.preventDefault();
		
		$('#overlay').remove();
		$(this).parent().hide();
	});

});
</script>
<div id="new-container">
	<a class="close" href="" aria-label="Button to close the contact form."><div style="margin: 0px auto; width:20px;">&times;</div></a>
	<?php 
	echo whatnewen($database);
	echo whatnewcy($database);
	?>
	
</div>